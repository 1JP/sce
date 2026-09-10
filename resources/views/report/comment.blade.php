@extends('layouts.report')

@section('title','Relatório Comentários')

@section('content')
<admin-report-comment 
    :post='@json($post)'
/>
@endsection