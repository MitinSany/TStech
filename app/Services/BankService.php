<?php

namespace App\Services;


use App\Models\Deposit;

class BankService
{
    public function doDailyTasks() {

        $deposits = Deposit::all()->map(function ($deposit) {
            $deposit->doAccrual();
            $deposit->doFee();
            $deposit->save();
        });

        echo "done\n";
    }
}