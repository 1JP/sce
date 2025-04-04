@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Planos" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <admin-plan-index
                :ths='@json($ths)'
            />
        </div>
    </div>
</div>

<admin-plan-create
    :title="'Cadastrar Categoria'"
    :name-id="'createPlanModal'"
/>

@endsection