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
            <form action="{{ route('expenses.store') }}" method="POST" class="row">
                @csrf
                <div class="col-md-4">
                    <label for="type" class="form-label">Type</label>
                    <select type="text" class="form-select" id="type" name="type">
                        @if(empty(old('type')))
                            <option selected disabled>Choose...</option>
                        @endif
                        @foreach(\App\ExpenseType::cases() as $expenseType)
                            <option
                                value="{{ $expenseType->value }}"
                                @if($expenseType->value === old('type')) selected @endif
                            >
                                {{ ucfirst($expenseType->value) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label for="receiver" class="form-label">Receiver</label>
                    <select type="text" class="form-select" id="receiver" name="receiver">
                        @if(empty(old('receiver')))
                            <option selected disabled>Choose...</option>
                        @endif
                        @foreach($receivers as $receiver)
                            <option
                                value="{{ $receiver->id }}"
                                @if($receiver->id === (int)old('receiver')) selected @endif
                            >
                                {{ ucfirst($receiver->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount') }}">
                </div>
                <div class="col-8 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
                </div>
                <div class="col-md-3">
                    <label for="payment_year" class="form-label">Year</label>
                    <select type="number" class="form-select" id="payment_year" name="payment_year">
                        @if(empty(old('payment_year')))
                            <option selected disabled>Choose...</option>
                        @endif
                        @for($i = date('Y'); $i >= 2015; $i--)
                            <option
                                @if($i === (int)old('payment_year')) selected @endif
                                value="{{ $i }}"
                            >
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="payment_month" class="form-label">Month</label>
                    <select type="number" class="form-select" id="payment_month" name="payment_month">
                        @if(empty(old('payment_month')))
                            <option selected disabled>Choose...</option>
                        @endif
                        @for($i = 1; $i <= 12; $i++)
                            <option
                                @if($i === (int)old('payment_month')) selected @endif
                                value="{{ $i }}"
                            >
                                {{ date('F', mktime(0, 0, 0, $i)) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="due_date" class="form-label">Due date</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}">
                </div>
                <div class="col-md-3 mb-4">
                    <label for="payment_date" class="form-label">Payment date</label>
                    <input type="date" class="form-control" id="payment_date" name="payment_date" value="{{ old('due_date') }}">
                </div>
                <div class="col-12 mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_paid" name="is_paid" @if(old('is_paid') === 'on') checked @endif>
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
