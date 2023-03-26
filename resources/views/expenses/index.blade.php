@extends('layouts.app')
@section('content')
<style>
    .grid-striped .row:nth-of-type(odd) {
        background-color: rgba(0,0,0,.05);
    }
    ul.nav li.nav-item button.active {
        background-color: #212529;
        color: white;
    }
</style>

    <div style="display: flex; flex-flow: column; height: 100vh; min-width: 1200px;">

        <!-- Header begin -->
        <div style="flex: 0 1 auto;" class="pt-2">
            <ul class="nav nav-tabs mx-2" id="incomeTypeTabs" role="tablist">
                @foreach(\App\ExpenseType::cases() as $id => $expenseType)
                    <li class="nav-item" role="presentation">
                        <button class="border-0 nav-link {{ $id === 0 ? 'active' : '' }}"
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
            <div class="m-0">
                <div class="row row-cols-lg-9 fw-bold text-white bg-dark py-2 mx-2">
                    <div class="col">Receiver</div>
                    <div class="col">Description</div>
                    <div class="col">Type</div>
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
        <div class="tab-content" id="incomesTypeTabsContent" style="flex: 1 1 auto; overflow-y: scroll; overflow-x: scroll">
            @foreach(\App\ExpenseType::cases() as $id => $expenseType)
                <div class="tab-pane fade {{ $id === 0 ? 'show active' : '' }}"
                     id="{{ $expenseType->value }}"
                     role="tabpanel"
                     aria-labelledby="{{ $expenseType->value }}-tab"
                     style="overflow-x: scroll;"
                >
                    <div class="grid-striped">
                        @foreach ($expenses[$expenseType->value] as $expense)
                            <div class="row row-cols-lg-9 py-2 mx-2">
                                <div class="col">{{ $expense->receiver }}</div>
                                <div class="col">{{ $expense->description }}</div>
                                <div class="col">{{ $expense->type }}</div>
                                <div class="col">{{ $expense->payment_year }}</div>
                                <div class="col">{{ date('F', mktime(0, 0, 0, $expense->payment_month, 10)) }}</div>
                                <div class="col">{{ $expense->amount }}</div>
                                <div class="col">{{ $expense->due_date }}</div>
                                <div class="col">{{ $expense->payment_date }}</div>
                                <div class="col">{{ $expense->is_paid ? 'yes' : 'no' }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Content end -->

        <!-- Footer begin -->
        <div class="border-top" style="flex: 0 1 100px;">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Expense type</th>
                                <th scope="col">Sum</th>
                                <th scope="col">Percent</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\ExpenseType::cases() as $expenseType)
                                <tr>
                                    <td class="fw-bold text-{{ \App\ExpenseType::color($expenseType->value) }}">
                                        {{ ucfirst($expenseType->value) }}
                                    </td>
                                    <td>
                                        @if (empty($expensesSum[$expenseType->value]))
                                            0.00
                                        @else
                                            {{ number_format($expensesSum[$expenseType->value], 2, '.', ' ') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($expensesSum[$expenseType->value]))
                                            0%
                                        @else
                                            {{ number_format(($expensesSum[$expenseType->value] * 100 / array_sum($expensesSum)), 2) }}%
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col">
                        <div class="progress mx-4" style="height: 3rem;">
                            @foreach($expensesSum as $expenseType => $amount)
                                <div class="progress-bar bg-{{ \App\ExpenseType::color($expenseType) }}"
                                     role="progressbar"
                                     style="width: {{ $amount * 100 / array_sum($expensesSum) }}%"
                                ></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer end -->
    </div>

@endsection
