<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name', 'Budget') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>
<body class="d-flex">

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 200px; height: 100vh;">
    <a href="{{ route('home.index') }}"
       class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">{{ config('app.name', 'Budget') }}</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="{{ route('home.index') }}" class="nav-link text-white
            {{ explode('.', Route::currentRouteName())[0] === 'home' ? 'active' : '' }}
            "><i class="bi bi-house-door me-2"></i>Home</a>
        </li>
        <li>
            <a href="{{ route('incomes.index') }}" class="nav-link text-white
            {{ explode('.', Route::currentRouteName())[0] === 'incomes' ? 'active' : '' }}
            "><i class="bi bi-box-arrow-in-down-right me-2"></i>Incomes</a>
        </li>
        <li>
            <a href="{{ route('expenses.index') }}" class="nav-link text-white
            {{ explode('.', Route::currentRouteName())[0] === 'expenses' ? 'active' : '' }}
            "><i class="bi bi-box-arrow-up-right me-2"></i>Expenses</a>
            @if(explode('.', Route::currentRouteName())[0] === 'expenses')
                <ul class="list-unstyled ps-4">
                    <li class="my-2">
                        <a href="{{ route('expenses.create') }}"
                           class="text-white text-decoration-none
                        "><i class="bi bi-plus-lg me-2"></i>Add</a>
                    </li>
                    <li class="my-2">
                        <a href="{{ route('expenses.report') }}"
                           class="text-white text-decoration-none
                        "><i class="bi bi-clipboard2-data me-2"></i>Report</a>
                    </li>
                </ul>
            @endif
        </li>
        <li>
            <a href="{{ route('receivers.index') }}" class="nav-link text-white
            {{ explode('.', Route::currentRouteName())[0] === 'receivers' ? 'active' : '' }}
            "><i class="bi bi-people me-2"></i>Recievers</a>
            @if(explode('.', Route::currentRouteName())[0] === 'receivers')
                <ul class="list-unstyled ps-4">
                    <li class="my-2">
                        <a href="{{ route('receivers.create') }}"
                           class="text-white text-decoration-none
                        "><i class="bi bi-plus-lg me-2"></i>Add</a>
                    </li>
                </ul>
            @endif
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
           id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" class="rounded-circle me-2" width="32" height="32">
            <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div>
</div>

<main class="flex-fill bg-light">
    @yield('content')
</main>
</body>
</html>
