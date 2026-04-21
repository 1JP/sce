@extends('layouts.app')

@section('css')
    <style>

        .list-comments {
            max-height: 300px; /* Define a altura máxima da div */
            overflow-y: auto; /* Exibe a barra de rolagem somente no eixo vertical */
            overflow-x: hidden; /* Evita barra de rolagem horizontal */
            border: 1px solid #ddd; /* Opcional: Adiciona uma borda para destacar a div */
            padding: 10px; /* Opcional: Adiciona espaço interno */
        }

        .btn-group .btn {
            width: 2rem;  /* Define a largura do botão */
            height: 2rem; /* Define a altura do botão */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cell {
            text-align: left !important; /* Garante alinhamento à esquerda */
            padding: 0 !important; /* Remove qualquer espaçamento adicional */
            vertical-align: middle; /* Alinha verticalmente ao centro da célula */
        }

        .btn-group {
            margin-left: 0 !important; /* Remove qualquer margem extra */
        }

        .btn-group button {
            display: inline-flex; /* Garante que o botão siga o alinhamento flexível */
            justify-content: center;
            align-items: center;
        }

        /* Inicialmente, esconda os botões */
        .hover-actions-trigger .btn {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        /* Ao passar o mouse sobre o contêiner, exiba os botões */
        .hover-actions-trigger:hover .btn {
            opacity: 1;
            visibility: visible;
        }

    </style>
@endsection

@section('content')

<div class="pt-3">
    <div class="container">
      <div class="row mx-0">
        <div class="col-md-12 px-0">
            <breadcrumb :items="{{ json_encode([
                [ 'name' => $post->category->name, 'route' => route('categorias.show', $post->category->id) ],
                [ 'name' => $post->name ]
            ]) }}"
            :icone="'bi bi-house-door text-muted'"
            :text-color="''">
            </breadcrumb>
        </div>
      </div>
    </div>
</div>

<site-post-show
    :post="{{ json_encode($post) }}"
    :user="{{ json_encode($user) }}"
></site-post-show>

@endsection