@extends('layouts.report')

@section('title','Relatório Geral')

@section('content')

<admin-report-general
    :post='@json($post)'
/>

@endsection