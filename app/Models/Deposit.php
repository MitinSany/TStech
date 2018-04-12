<?php

namespace App\Models;

use App\Events\DepositChangeValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;

class Deposit extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['client_id', 'last_commission_month', 'value', 'percent'];

    public function setValueAttribute($value)
    {
        $originalValue = $this->value;
        Event::fire(new DepositChangeValue($this->id, $value - $originalValue));
        $this->attributes['value'] = $value;
    }

    public function getAccrualAttribute()
    {
        $percent = $this->percent / 100;
        return $this->value * $percent;
    }

    public function getFeeAttribute()
    {
        $fee = 0;
        if ($this->value >= 0 && $this->value < 1000) {
            /*
             *  strange condition, because 1000$ * 5% = 50$
             *
            $fee = $this->value * 0.05;
            $fee = $fee > 50 ?  $fee :  50;
            */
            $fee = 50;
        } elseif ($this->value >= 1000 && $this->value < 10000) {
            $fee = $this->value * 0.06;
        } elseif ($this->value >= 10000) {
            $fee = $this->value * 0.07;
            $fee = $fee < 5000 ? $fee : 5000;
        }

        $currentMonth = (int)(new \DateTime())->format('m');
        $createDt = new \DateTime($this->creation_ts);
        $createMonth = (int)$createDt->format('m');
        $createDay = (int)$createDt->format('d');

        //deposit registered last month
        if ($createMonth + 1 == $currentMonth) {
            $monthDays = date('t');
            $depositDays = $monthDays - $createDay + 1;
            $monthCoef = $depositDays / $monthDays;
            $fee *= $monthCoef;
        }
        return $fee;
    }

    protected function ifAccrualDay()
    {
        return true;
        $depositDay = (new \DateTime($this->creation_ts))->format('d');
        $currentDay = (new \DateTime())->format('d');
        return $currentDay == $depositDay;
    }

    protected function ifFeeDay()
    {
        return true;
        $currentDay = (new \DateTime($this->creation_ts))->format('d');
        return ($currentDay == 1);
    }

    public function doAccrual()
    {
        if ($this->ifAccrualDay()) {
            $this->value += $this->accrual;
        }
    }

    public function doFee()
    {
        $currentMonth = (int)(new \DateTime())->format('m');
        //protect for again sub fee from user
        if ($currentMonth == $this->last_commission_month) {
            return;
        }
        if ($this->ifFeeDay()) {
            $this->value -= $this->fee;
            $this->last_commission_month = $currentMonth;
        }
    }

    static public function sumPerGroups() {
        return DB::table('deposits')
            ->selectRaw("SUM(deposits.`value`)/COUNT(1) `value`,
IF(TIMESTAMPDIFF (YEAR, clients.birth_date, CURDATE()) >='18' && TIMESTAMPDIFF (YEAR, clients.birth_date, CURDATE()) <'25', 1,
  IF(TIMESTAMPDIFF (YEAR, clients.birth_date, CURDATE()) >='25' && TIMESTAMPDIFF (YEAR, clients.birth_date, CURDATE()) <'50', 2,
      IF(TIMESTAMPDIFF (YEAR, clients.birth_date, CURDATE()) >='50',  3, 1)

  )
) `group`")
            ->join('clients', 'clients.id', '=', 'deposits.client_id')
            ->groupBy('group')
            ->get();
    }
}
