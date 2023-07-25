<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $expenses = Expense::where(['payment_month' => date('m'), 'payment_year' =>date('Y')])
                           ->orderBy('is_paid')
                           ->get();
        $sumPaid = 0;
        $sumUnpaid = 0;
        foreach ($expenses as $expense) {
            $amount = $expense['amount'];
            $expense['is_paid'] === 1 ? $sumPaid += $amount : $sumUnpaid += $amount;
        }
        $sumTotal = $sumPaid + $sumUnpaid;

        return view('home.index')->with(compact('expenses', 'sumTotal', 'sumPaid', 'sumUnpaid'));
    }
}
