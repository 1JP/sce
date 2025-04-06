@extends('layouts.app')

@section('content')
<div class="container">
    <site-create-user :email="'{{ $email }}'"/>
</div>
@endsection