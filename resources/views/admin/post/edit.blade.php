@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Posts", "route" => route("admin.posts.index") ],
        [ "name" => "Editar" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <admin-post-edit
                :post='@json($post)'
            />
        </div>
    </div>
</div>
@endsection