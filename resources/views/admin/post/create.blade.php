@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Posts", "route" => route("admin.posts.index") ],
        [ "name" => "Criar" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <admin-post-create/>
      </div>
    </div>
</div>
@endsection