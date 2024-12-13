@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Dashboard" ]
    ])'></breadcrumb>
@endsection

@section('content')
    @php
        $infos = [
            [
                "name" => "Novas Assinaturas",
                "value" => "$53,00",
                "description" => "+55% Último mês",
                "color" => "shadow-primary bg-gradient-primary",
                "icon" => "ni ni-money-coins"
            ],
            [
                "name" => "Usuários",
                "value" => "4",
                "description" => "+3% Último mês",
                "color" => "shadow-danger bg-gradient-danger",
                "icon" => "ni ni-world"
            ],
            [
                "name" => "Novos Clientes",
                "value" => "+3",
                "description" => "-2% Último mês",
                "color" => "bg-gradient-success shadow-success",
                "icon" => "ni ni-paper-diploma"
            ],
            [
                "name" => "Valor total",
                "value" => "$103,430",
                "description" => "Mês atual",
                "color" => "bg-gradient-warning shadow-warning",
                "icon" => "ni ni-money-coins"
            ]
        ]; 
    @endphp
    <div class="row">
        @foreach ($infos as $info)
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <admin-card-info 
                    :name='@json($info["name"])'
                    :value='@json($info["value"])'
                    :description='@json($info["description"])'
                    :color='@json($info["color"])'
                    :icon='@json($info["icon"])'
                ></admin-card-info>
            </div>
        @endforeach
    </div>
    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Comentários</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">4% more</span> in 2024
                    </p>
                </div>
                <div class="card-body p-3">
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card z-index-2 h-100">
                <div class="card-header pb-0 pt-3 bg-transparent">
                    <h6 class="text-capitalize">Like e Deslike</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">4% more</span> in 2024
                    </p>
                </div>
                <div class="card-body p-3">
                </div>
            </div>
        </div>
    </div>
@endsection