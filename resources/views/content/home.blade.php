@extends('layouts.master')

@section('content')
<h1>Caloggeros in Italy</h1>
<img src="{{ Storage::disk('s3')->url('20240522_120929.jpg') }}">
@endsection