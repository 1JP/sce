@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Categorias" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <admin-category-index
                :types='@json($types)'
                :ths='@json($ths)'
            />
        </div>
    </div>
</div>

<admin-category-create
    :title="'Cadastrar Categoria'"
    :name-id="'createCategoryModal'"
    :types='@json($types)'
/>
@endsection