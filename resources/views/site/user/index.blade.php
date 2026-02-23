@extends('layouts.app')

@section('content')
@php
    $roles = ['Admin', 'Membros', 'Root', 'Client'];
@endphp

<div class="py-5">
    <div class="container">
        <site-index-user
            :is-role="@json(!Auth::user()->hasAnyRole($roles))"
            :user='@json(Auth::user())'
        />
    </div>
</div>

@endsection