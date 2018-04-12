<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const CREATED_AT = 'creation_date';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['deposit_id', 'value'];

    static public function transactionsPerMonth()
    {
        return self::selectRaw('month(creation_ts) `month`, sum(`value`) `sum`')
            ->groupBy('month')
            ->orderBy('month', 'DESC')
            ->get();
    }

}
