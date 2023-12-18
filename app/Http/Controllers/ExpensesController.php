<?php

namespace App\Http\Controllers;

use App\ExpenseType;
use App\Models\Expense;
use App\Models\Receiver;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

        $expenses[ExpenseType::INSURANCE->value] =
            Expense::where('type', ExpenseType::INSURANCE->value)
                   ->orderByDesc('payment_year')
                   ->orderByDesc('payment_month')
                   ->get();

        $expenses[ExpenseType::ACCOMMODATION->value] =
            Expense::where('type', ExpenseType::ACCOMMODATION->value)
                   ->orderByDesc('payment_year')
                   ->orderByDesc('payment_month')
                   ->get();

        $expenses[ExpenseType::BILLS->value] =
            Expense::where('type', ExpenseType::BILLS->value)
                   ->orderByDesc('payment_year')
                   ->orderByDesc('payment_month')
                   ->get();

        $expenses[ExpenseType::INSTALLMENT->value] =
            Expense::where('type', ExpenseType::INSTALLMENT->value)
                   ->orderByDesc('payment_year')
                   ->orderByDesc('payment_month')
                   ->get();

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
        return view('expenses.create', [
            'receivers' => Receiver::where('is_active', true)->get()->sortBy('name')
        ]);
    }

    public function copy()
    {
        $expense = Session::pull('last_edited_expense');
        if (!empty($expense)) {
            return redirect()->route('expenses.create')->withInput([
                'type' => $expense->type,
                'receiver' => $expense->receiver->id,
                'amount' => 0,
                'description' => $expense->description,
                'payment_year' => $expense->payment_year,
                'payment_month' => $expense->payment_month
            ]);
        }
        return redirect()->route('expenses.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver' => 'required|integer|min:1',
            'description' => 'required|max:255',
            'type' => 'required|max:255',
            'amount' => ['required', 'numeric', function ($attribute, $value, $fail) use ($request) {
                if ($request->is_paid === 'on' && $value <= 0) {
                    $fail('Amount should be positive if expense is marked as paid');
                }
            }],
            'due_date' => 'required',
            'payment_date' => '',
            'payment_month' => 'required|min:1|max:12',
            'payment_year' => 'required'
        ]);

        Expense::create([
            'receiver_id' => $request->receiver,
            'description' => $request->description,
            'type' => $request->type,
            'amount' => str_replace(',', '.', $request->amount),
            'due_date' => $request->due_date,
            'payment_date' => $request->payment_date,
            'payment_month' => $request->payment_month,
            'payment_year' => $request->payment_year,
            'is_paid' => $request->is_paid === 'on'
        ]);

        return redirect(route('expenses.index'));
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
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $expense = Expense::where('id', $id)->first();
        $receivers = Receiver::where('is_active', true)->get()->sortBy('name');
        if (!$receivers->has($expense->receiver->id)) {
            $receivers->prepend($expense->receiver);
        }
        Session::put('last_edited_expense', $expense);

        return view('expenses.edit', compact('expense', 'receivers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'receiver' => 'required|integer|min:1',
            'description' => 'required|max:255',
            'type' => 'required|max:255',
            'amount' => ['required', 'numeric', function ($attribute, $value, $fail) use ($request) {
                if ($request->is_paid === 'on' && $value <= 0) {
                    $fail('Amount should be positive if expense is marked as paid');
                }
            }],
            'due_date' => 'required',
            'payment_date' => 'required_with:is_paid',
            'payment_month' => 'required|min:1|max:12',
            'payment_year' => 'required'
        ]);

        Expense::where('id', $id)->update([
            'receiver_id' => $request->receiver,
            'description' => $request->description,
            'type' => $request->type,
            'amount' => str_replace(',', '.', $request->amount),
            'due_date' => $request->due_date,
            'payment_date' => $request->payment_date,
            'payment_month' => $request->payment_month,
            'payment_year' => $request->payment_year,
            'is_paid' => $request->is_paid === 'on'
        ]);

        return redirect(route('expenses.index'));
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
