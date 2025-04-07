@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-9">
            <site-create-user :email="'{{ $email }}'" :route-form="'{{ route('usuarios.store') }}'"/>
        </div>
    </div>
</div>
@endsection