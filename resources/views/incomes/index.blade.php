@extends('layouts.app')
@section('content')


    <div style="display: flex; flex-flow: column; height: 100vh;">

        <!-- Header begin -->
        <div style="flex: 0 1 auto;" class="pe-2">
            <h1>Incomes</h1>
            <ul class="nav nav-tabs" id="incomeTypeTabs" role="tablist">
                @foreach(\App\ExpenseType::cases() as $id => $expenseType)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $id === 0 ? 'active' : '' }}"
                                id="{{ $expenseType->value }}-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#{{ $expenseType->value }}"
                                type="button"
                                role="tab"
                                aria-controls="{{ $expenseType->value }}"
                                aria-selected="{{ $id === 0 ? 'true' : 'false' }}">
                            {{ ucfirst($expenseType->value) }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <table class="table table-dark mb-0">
                <tr>
                    <th class="col-1">Receiver</th>
                    <th class="col-1">Description</th>
                    <th class="col-1">Type</th>
                    <th class="col-1">Year</th>
                    <th class="col-1">Month</th>
                    <th class="col-1">Amount</th>
                    <th class="col-1">Due date</th>
                    <th class="col-1">Payment date</th>
                    <th class="col-1">Is paid</th>
                </tr>
            </table>
        </div>
        <!-- Header end -->

        <!-- Content begin -->
        <div class="tab-content" id="incomesTypeTabsContent"
             style="flex: 1 1 auto; overflow-y: scroll"
        >
            @foreach(\App\ExpenseType::cases() as $id => $expenseType)
                <div class="tab-pane fade {{ $id === 0 ? 'show active' : '' }}"
                     id="{{ $expenseType->value }}"
                     role="tabpanel"
                     aria-labelledby="{{ $expenseType->value }}-tab"
                >
                    <table class="table table-striped">
                        @foreach ($expenses[$expenseType->value] as $expense)
                            <tr>
                                <td class="col-1">{{ $expense->receiver }}</td>
                                <td class="col-1">{{ $expense->description }}</td>
                                <td class="col-1">{{ $expense->type }}</td>
                                <td class="col-1">{{ $expense->payment_year }}</td>
                                <td class="col-1">{{ date('F', mktime(0, 0, 0, $expense->payment_month, 10)) }}</td>
                                <td class="col-1">{{ $expense->amount }}</td>
                                <td class="col-1">{{ $expense->due_date }}</td>
                                <td class="col-1">{{ $expense->payment_date }}</td>
                                <td class="col-1">{{ $expense->is_paid ? 'yes' : 'no' }}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            @endforeach
        </div>
        <!-- Content end -->

        <!-- Footer begin -->
        <div style="flex: 0 1 40px;">
            <p>FOOTER WITH FIXED HEIGHT</p>
        </div>
        <!-- Footer end -->
    </div>

@endsection
