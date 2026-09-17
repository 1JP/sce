@extends('layouts.admin-app')

@section('css')
    <style>
        .dropdown-divider {
            height: 0;
            margin: 0.5rem 0;
            overflow: hidden;
            border-top: 1px solid #e9ecef;
        }
    </style>
@endsection

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Posts" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <admin-post-index 
                :ths='@json($ths)'
                :created='{{ Auth::user()->isAdminOrRoot() }}'
            />
        </div>
    </div>
</div>
@endsection