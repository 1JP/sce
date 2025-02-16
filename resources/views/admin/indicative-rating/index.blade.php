@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Classificação Indicativa" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <admin-indicative-index
                :ths='@json($ths)'
            />
        </div>
    </div>
</div>

<admin-indicative-create
    :title="'Cadastrar Classificação Indicativa'"
    :name-id="'createIndicativeModal'"
/>

@endsection