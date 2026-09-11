@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Dashboard" ]
    ])'></breadcrumb>
@endsection

@section('content')
    @if (Auth::user()->hasRole('Root'))
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
    @endif
    <admin-dashboard
        :labels='{!! json_encode(["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]) !!}'
    />
@endsection