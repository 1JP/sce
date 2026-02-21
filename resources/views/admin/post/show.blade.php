@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Posts", "route" => route("admin.posts.index") ],
        [ "name" => "Visualização" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <admin-post-show 
                :post='@json($post)'
                :category = '@json($post->category)'
                :indicative_rating = '@json($post->indicative_rating)'
                :images = '@json($post->images)'
            />
        </div>
    </div>
</div>
<fixed-bottom
    :cancel="'{{ route('admin.posts.index') }}'"
    :route="'{{ route('admin.posts.edit', $post->id) }}'"
    :name="'Editar'"
></fixed-bottom>
@endsection