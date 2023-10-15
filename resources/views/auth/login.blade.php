@extends('layouts.app')
@section('content')

    <div class="row m-0 mt-5">
        <div class="col-2"></div>
        <div class="col-8">

            <form action="{{ route('auth.authenticate') }}" method="POST" class="row">
                @csrf
                <div class="col-4 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="col-4 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-2"></div>
    </div>

@endsection
