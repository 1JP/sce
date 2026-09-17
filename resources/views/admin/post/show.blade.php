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
                :category_type = '@json($post->category_type)'
                :likes_percentage = '@json($post->likes_percentage())'
                :dislikes_percentage = '@json($post->dislikes_percentage())'
                :positive_comments_percentage = '@json($post->positive_comments_percentage())'
                :negative_comments_percentage = '@json($post->negative_comments_percentage())'
                :neutral_comments_percentage = '@json($post->neutral_comments_percentage())'
            />
        </div>
    </div>
</div>
@endsection