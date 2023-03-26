<?php

namespace App\Http\Controllers;

use App\ExpenseType;
use App\Models\Expense;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $expenses = [];
        $expenses[ExpenseType::COMMUNICATION->value] =
            Expense::where('type', ExpenseType::COMMUNICATION->value)
                   ->orderByDesc('payment_year')
                   ->orderByDesc('payment_month')
                   ->get();

        $expenses[ExpenseType::INSURANCE->value] = [];
        $expenses[ExpenseType::ACCOMMODATION->value] = [];
        $expenses[ExpenseType::ENERGY->value] = [];
        $expenses[ExpenseType::INSTALLMENT->value] = [];

        $expenses[ExpenseType::ENTERTAINMENT->value] =
            Expense::where('type', ExpenseType::ENTERTAINMENT->value)
                   ->orderByDesc('payment_year')
                   ->orderByDesc('payment_month')
                   ->get();

        $expensesSum = [];
        foreach (ExpenseType::cases() as $expenseType) {
            if (!empty($expenses[$expenseType->value])) {
                $expensesSum[$expenseType->value] = $expenses[$expenseType->value]
                    ->where('type', $expenseType->value)
                    ->sum('amount');
            }
        }

        return view('expenses.index')->with(compact('expenses', 'expensesSum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show report.
     *
     * @return Application|Factory|View
     */
    public function report()
    {
        return view('expenses.report');
    }
}
