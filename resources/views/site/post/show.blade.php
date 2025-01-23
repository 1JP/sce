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
            <breadcrumb :items='@json([
                [ "name" => "LIVROS", "route" => route('categorias.index') ],
                [ "name" => "Batman o cavaleiro das trevas"]
            ])' :icone="'bi bi-house-door text-muted'"
            :text-color="''"></breadcrumb>
        </div>
      </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3" style="background: #EDEBE4;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <site-carousel></site-carousel>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8">
                                <h2 class="card-title p-3">Batman o cavaleiro das trevas</h2>
                                <p class="card-text m-3">Não obstante, a percepção das dificuldades cumpre um papel essencial na formulação dos modos de operação convencionais.</p>
                                <form class="m-0">
                                    <div class="row m-1 align-items-center">
                                      <div class="col-lg-3">
                                        <input type="text" class="form-control">
                                      </div>
                                      <div class="col-lg-3">
                                        <button class="btn btn-primary text-light rounded-lg h-25 mt-0 me-0">Votar</button>
                                      </div>
                                    </div>
                                </form>
                                <p class="card-text m-3">Nota: 09.52</p>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="hover-actions-trigger top-0 m-3">
                                    <a class="me-2">
                                        <i class="bi bi-hand-thumbs-up"></i>
                                        400
                                    </a>
                                    <a class="me-1">
                                        <i class="bi bi-hand-thumbs-down"></i>
                                        52 mil
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 list-comments">
                                    <site-comment></site-comment>
                                </div>
                                <site-create-comment></site-create-comment>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection