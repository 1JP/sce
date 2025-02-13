@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Tipos de Categorias" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <admin-category-type-index
                :ths='@json($ths)'
            />
        </div>
    </div>
</div>

<admin-category-type-create
    :title="'Cadastrar Categoria'"
    :name-id="'createCategory'"
/>
@endsection