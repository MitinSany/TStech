<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Transaction;
use App\Services\BankService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function daily(BankService $bankService)
    {
        $bankService->doDailyTasks();
    }

    public function reportTransactions() {
        $transactionsPerMonth = Transaction::transactionsPerMonth();
        return view('report.transactions', ['transactions' => $transactionsPerMonth]);
    }

    public function reportSumPerGroups() {
        $sumPerGroups = Deposit::sumPerGroups();
        return view('report.sums', ['sums' => $sumPerGroups]);
    }
}
