<?php

namespace App\Listeners;

use App\Events\DepositChangeValue;
use App\Models\Transaction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DepositChangeValueListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DepositChangeValue  $event
     * @return void
     */
    public function handle(DepositChangeValue $event)
    {
        Transaction::create([
            'deposit_id' => $event->deposit_id,
            'value' => $event->value,
        ]);
    }
}
