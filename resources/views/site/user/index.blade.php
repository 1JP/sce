@extends('layouts.app')

@section('content')

<div class="py-5">
    <div class="container">
        <site-index-user
            :is-role="{{ $isRole }}"
            :user='@json(Auth::user())'
        />
    </div>
</div>

@endsection