@extends('layouts.app')
@section('content')

    <div class="row m-0 mt-5">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="row mb-3">
                @if ($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $id => $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <form action="{{ route('expenses.update', $expense->id) }}" method="POST" class="row">
                @csrf
                @method('PATCH')
                <div class="col-md-4">
                    <label for="type" class="form-label">Type</label>
                    <select type="text" class="form-select" id="type" name="type">
                        @foreach(\App\ExpenseType::cases() as $expenseType)
                            <option
                                value="{{ $expenseType->value }}"
                                @if($expense->type === $expenseType->value) selected @endif
                            >
                                {{ ucfirst($expenseType->value) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label for="receiver" class="form-label">Receiver</label>
                    <select type="text" class="form-select" id="receiver" name="receiver">
                        @foreach($receivers as $receiver)
                            <option
                                value="{{ $receiver->id }}"
                                @if($expense->receiver->id === $receiver->id) selected @endif
                            >
                                {{ ucfirst($receiver->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount" value="{{ $expense->amount }}">
                </div>
                <div class="col-8 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ $expense->description }}">
                </div>
                <div class="col-md-3">
                    <label for="payment_year" class="form-label">Year</label>
                    <select type="number" class="form-select" id="payment_year" name="payment_year">
                        @for($i = date('Y'); $i >= 2015; $i--)
                            <option
                                @if($expense->payment_year == $i) selected @endif
                                value="{{ $i }}">{{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="payment_month" class="form-label">Month</label>
                    <select type="number" class="form-select" id="payment_month" name="payment_month">
                        @for($i = 1; $i <= 12; $i++)
                            <option
                                @if($expense->payment_month == $i) selected @endif
                                value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i)) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="due_date" class="form-label">Due date</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $expense->due_date }}">
                </div>
                <div class="col-md-3 mb-4">
                    <label for="payment_date" class="form-label">Payment date</label>
                    <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ $expense->payment_date }}">
                </div>
                <div class="col-12 mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_paid" name="is_paid"
                            @if($expense->is_paid == 1) checked @endif
                        >
                        <label class="form-check-label" for="is_paid">Is paid</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-2"></div>
    </div>

@endsection
