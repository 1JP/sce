@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Logs" , "route" => route("admin.logs.index") ],
        [ "name" => "Visualizar log"]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <admin-log-show
                :log='@json($activity)'
            />
        </div>
    </div>
</div>
@endsection