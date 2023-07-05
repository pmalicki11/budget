@extends('layouts.app')
@section('content')
    <style>
        .grid-striped .row:nth-of-type(odd) {
            background-color: #e6e6e6;
        }
        .grid-striped .unpaid:nth-of-type(odd) {
            background-color: #ffcccc; !important
        }
        .grid-striped .unpaid:nth-of-type(even) {
            background-color: #ffe6e6; !important;
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

    <div style="display: flex; flex-flow: column; height: 100vh; min-width: 1200px;">

        <div class="mt-3">
            <div class="row row-cols-lg-9 fw-bold text-white bg-dark py-2 mx-2">
                <div class="col">Name</div>
                <div class="col">Is active</div>
            </div>
        </div>

        <div class="grid-striped">
            @foreach ($receivers as $receiver)
                <a href="{{ route('receivers.edit', $receiver->id) }}"
                   class="row row-cols-lg-9 py-2 mx-2 expense-row">
                    <div class="col">{{ $receiver->name }}</div>
                    <div class="col">{{ $receiver->is_active ? 'yes' : 'no' }}</div>
                </a>
            @endforeach
        </div>
    </div>

@endsection
