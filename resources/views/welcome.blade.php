@extends('layouts.master')

@section('content')
<div class="navbar">
    <div class="logo"></div>
    <ul>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
    </ul>
    <!-- <a href="" class="quote-button">Login</a> -->
</div>
<div class="banner">
    <div class="floating-box">
        <a href="{{ route('login') }}"> <button>Enter</button></a>
    </div>
</div>

@endsection