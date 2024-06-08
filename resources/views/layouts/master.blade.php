<!DOCTYPE html>

<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.head')
<!-- If it is a guest user, use cookies to set theme. -->
<body>
    @if(session('alert'))
        <!-- Alerts -->
        <div class="alert-success">
            <span class="alert-text">{{ session('alert') }}</span>
        </div>
    @endif
    @if ($errors->any())
        <!-- Errors -->
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Content -->
    @yield('content')

    @yield('scripts')

</body>
</html>
