@extends('layouts.master')

@section('content')
<h1>To Do Login Form</h1>
<form action="{{ route('login') }}" method="POST">
    @csrf
    <label for=""></label>
    <input type="text" name="email" id="" placeholder="email" class="email">
      
    <label for=""></label>
    <input type="password" name="password" id="" placeholder="password" class="pass">
      
    <button type="submit">login to your account</button>
      
</form>
  
@endsection