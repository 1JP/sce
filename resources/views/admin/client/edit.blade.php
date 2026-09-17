@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Clientes", "route" => route("admin.clientes.index") ],
        [ "name" => "Editar Cliente"]
    ])'></breadcrumb>
@endsection

@section('content')
    <admin-client-edit
        :client='@json($client)'
        :user='@json($client->user)'
    />
@endsection