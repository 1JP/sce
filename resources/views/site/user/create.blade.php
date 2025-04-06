@extends('layouts.app')

@section('content')
<div class="container">
    <site-create-user :email="'{{ $email }}'" :route-form="'{{ route('usuarios.store') }}'"/>
</div>
@endsection