@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Configurações" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row text-left">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12" style="">
                    <admin-settings-create/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection