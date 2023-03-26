@extends('layouts.app')
@section('content')

    <div class="row m-0 mt-5">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="{{ route('expenses.store') }}" method="POST" class="row">
                @csrf
                <div class="col-md-4">
                    <label for="type" class="form-label">Type</label>
                    <select type="text" class="form-select" id="type" name="type">
                        <option selected disabled>Choose...</option>
                        @foreach(\App\ExpenseType::cases() as $expenseType)
                            <option value="{{ $expenseType->value }}">
                                {{ ucfirst($expenseType->value) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label for="receiver" class="form-label">Receiver</label>
                    <input type="password" class="form-control" id="receiver" name="receiver">
                </div>
                <div class="col-4 mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount">
                </div>
                <div class="col-8 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="col-md-3">
                    <label for="year" class="form-label">Year</label>
                    <select type="number" class="form-select" id="year" name="year">
                        <option selected disabled>Choose...</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="month" class="form-label">Month</label>
                    <select type="number" class="form-control" id="month" name="month">
                        <option selected disabled>Choose...</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dueDate" class="form-label">Due date</label>
                    <input type="date" class="form-control" id="dueDate" name="dueDate">
                </div>
                <div class="col-md-3 mb-4">
                    <label for="paymentDate" class="form-label">Payment date</label>
                    <input type="date" class="form-control" id="paymentDate" name="paymentDate">
                </div>
                <div class="col-12 mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="isPaid" name="isPaid">
                        <label class="form-check-label" for="isPaid">Is paid</label>
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
