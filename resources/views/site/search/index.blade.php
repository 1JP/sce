@extends('layouts.app')

@section('css')
    <style>       
        /* Para o estado desativado (colapsado) */
        .accordion-item {
            background-color: #EDEBE4; /* Cor de fundo para quando o item estiver desativado */
        }

        /* Opção: Customizar o botão de "accordion-button" */
        .accordion-button:not(.collapsed) {
            background-color: black; /* Cor de fundo quando o botão estiver expandido */
        }

        .accordion-button:not(.collapsed) h3{
            color: white; /* Cor do texto no estado ativo */
        }

        .accordion-button.collapsed {
            background-color: #EDEBE4; /* Cor de fundo quando o botão estiver colapsado */
            color: #EDEBE4; /* Cor do texto do botão colapsado */
        }

        .form-check-label {
            font-weight: 500;
            color: #74642F;
            margin: 0;
        }

        .btn-block {
            display: block;
            width: 100%;
        }
    </style>
@endsection

@section('content')
<div class="pt-3">
    <div class="container">
      <div class="row mx-0">
        <div class="col-md-12 px-0">
            <breadcrumb :items='@json([])' :icone="'bi bi-house-door text-muted'"
            :text-color="''"></breadcrumb>
        </div>
      </div>
    </div>
</div>

<site-search 
    :search='@json($search)'
    :total='@json($posts->total())'
    :posts='@json($posts->getCollection())'
    :pagination='@json($posts->toArray())'
></site-search>
@endsection