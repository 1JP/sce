@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Assinatura" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12 mt-4">
            <admin-subscription-index
                :subscription='@json($subscription)'
            />
        </div>
    </div>
</div>

@endsection