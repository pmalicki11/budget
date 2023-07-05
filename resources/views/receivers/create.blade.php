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
            <form action="{{ route('receivers.store') }}" method="POST" class="row">
                @csrf
                <div class="col-4 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="col-12 mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active">
                        <label class="form-check-label" for="is_active">Is active</label>
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
