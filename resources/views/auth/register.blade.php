@extends('layouts.master')

@section('content')
<div class="banner">
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label for=""></label>
        <input type="text" name="email" id="" placeholder="email" class="email">

        <input type="text" name="name" placeholder="name" class="name">
          
        <label for=""></label>
        <input type="password" name="password" id="" placeholder="password" class="pass">

        <input type="password" name="confirm" placeholder="confirm password" class="pass">
          
        <button type="submit">create your account</button>
          
    </form>
</div>
  
@endsection