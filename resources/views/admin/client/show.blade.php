@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Clientes", "route" => route("admin.clientes.index") ],
        [ "name" => "Visualizar Cliente"]
    ])'></breadcrumb>
@endsection

@section('content')
    <admin-client-show
        :client='@json($client)'
        :user='@json($client->user)'
        :subscription='@json($client->user->subscription)'
        :plan='@json($client->user->subscription->plan)'
    />
@endsection