@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Dashboard" ]
    ])'></breadcrumb>
@endsection

@section('content')
    @if (Auth::user()->hasRole('Root'))
        <admin-dashboard-root></admin-dashboard-root>
    @endif
    
    <admin-dashboard
        :labels='{!! json_encode(["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]) !!}'
    />
@endsection