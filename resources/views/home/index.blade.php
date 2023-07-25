@extends('layouts.app')
@section('content')
    <style>
        .grid-striped .row:nth-of-type(odd) {
            background-color: #e6e6e6;
        }

        .grid-striped .unpaid:nth-of-type(odd) {
            background-color: #ffcccc;
        !important
        }

        .grid-striped .unpaid:nth-of-type(even) {
            background-color: #ffe6e6;
        !important;
        }

        .grid-striped .expense-row {
            color: inherit;
            text-decoration: none;
        }

        .grid-striped .expense-row:hover {
            background-color: #212529;
            color: white;
            cursor: pointer;
        }

        ul.nav li.nav-item button.active {
            background-color: #212529;
            color: white;
        }
    </style>
    <div class="mx-2">
        <h1>Home page</h1>
        <h3>Current expenses</h3>
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Total
                <span class="ms-2 p-2 badge bg-primary rounded-pill">{{ $sumTotal }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Paid
                <span class="ms-2 p-2 badge bg-success rounded-pill">{{ $sumPaid }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Unpaid
                <span class="ms-2 p-2 badge bg-danger rounded-pill">{{ $sumUnpaid }}</span>
            </li>
        </ul>
    </div>
    <div style="display: flex; flex-flow: column; min-width: 1200px;">
        <!-- Header begin -->
        <div style="flex: 0 1 auto;" class="pt-2">
            <div class="m-0">
                <div class="row row-cols-lg-9 fw-bold text-white bg-dark py-2 mx-2">
                    <div class="col">Receiver</div>
                    <div class="col">Description</div>
                    <div class="col">Year</div>
                    <div class="col">Month</div>
                    <div class="col">Amount</div>
                    <div class="col">Due date</div>
                    <div class="col">Payment date</div>
                    <div class="col">Is paid</div>
                </div>
            </div>
        </div>
        <!-- Header end -->

        <!-- Content begin -->
        <div class="grid-striped">
            @foreach ($expenses as $expense)
                <a href="{{ route('expenses.edit', $expense->id) }}"
                   class="row row-cols-lg-9 py-2 mx-2 expense-row {{!$expense->is_paid ? 'unpaid' : ''}}">
                    <div class="col">{{ $expense->receiver->name }}</div>
                    <div class="col">{{ $expense->description }}</div>
                    <div class="col">{{ $expense->payment_year }}</div>
                    <div class="col">{{ date('F', mktime(0, 0, 0, $expense->payment_month)) }}</div>
                    <div class="col">{{ $expense->amount }}</div>
                    <div class="col">{{ $expense->due_date }}</div>
                    <div class="col">{{ $expense->payment_date }}</div>
                    <div class="col">{{ $expense->is_paid ? 'yes' : 'no' }}</div>
                </a>
            @endforeach
        </div>
        <!-- Content end -->

    </div>
@endsection
