@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Posts", "route" => route("admin.posts.index") ],
        [ "name" => "Visualização" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-4">
                            <h6>Visualizar Post</h6>
                        </div>
                        <div class="col-lg-8 d-flex justify-content-end">
                            <a href="{{ route('admin.posts.index') }}" class="btn bg-gradient-primary">
                                Voltar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="card-body border rounded">
                        <div class="row">
                            <div class="col-12 my-1 col-lg-6" style="">
                                <h5 class="text-dark">Nome do Post:</h5>
                                <p><span>Lorem ipsum</span></p>
                            </div>
                            <div class="col-12 my-1 col-lg-3" style="">
                                <h5 class="text-dark">Post ativado?</h5>
                                <p><span>Sim</span></p>
                            </div>
                            <div class="col-12 my-1 col-lg-3" style="">
                                <h5 class="text-dark">Comentarios positivos</h5>
                                <p><span>60%</span></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12 my-1 col-lg-12" style="">
                                <h5 class="text-dark">Detalhes</h5>
                                <p><span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span></p>
                            </div>
                            <div class="col-12 my-1 col-lg-3" style="">
                                <h5 class="text-dark">Categoria</h5>
                                <p>Nome da Categoria</p>
                            </div>
                            <div class="col-12 my-1 col-lg-3" style="">
                                <h5 class="text-dark">Classificação Indicativa</h5>
                                <p><span>Não</span></p>
                            </div>
                            <div class="col-12 my-1 col-lg-3" style="">
                                <h5 class="text-dark">Like</h5>
                                <p><span>80</span></p>
                            </div>
                            <div class="col-12 my-1 col-lg-3" style="">
                                <h5 class="text-dark">Deslike</h5>
                                <p><span>80</span></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 my-1 col-lg-6" style="">
                                <h5 class="text-dark">Fotos</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-6 p-3"> <img class="img-fluid d-block" src="https://static.pingendo.com/img-placeholder-1.svg"> </div>
                                    <div class="col-lg-3 col-6 p-3"> <img class="img-fluid d-block" src="https://static.pingendo.com/img-placeholder-2.svg"> </div>
                                    <div class="col-lg-3 col-6 p-3"> <img class="img-fluid d-block" src="https://static.pingendo.com/img-placeholder-3.svg"> </div>
                                    <div class="col-lg-3 col-6 p-3"> <img class="img-fluid d-block" src="https://static.pingendo.com/img-placeholder-4.svg"> </div>
                                    <div class="col-lg-3 col-6 p-3"> <img class="img-fluid d-block" src="https://static.pingendo.com/img-placeholder-3.svg"> </div>
                                    <div class="col-lg-3 col-6 p-3"> <img class="img-fluid d-block" src="https://static.pingendo.com/img-placeholder-4.svg"> </div>
                                    <div class="col-lg-3 col-6 p-3"> <img class="img-fluid d-block" src="https://static.pingendo.com/img-placeholder-1.svg"> </div>
                                    <div class="col-lg-3 col-6 p-3"> <img class="img-fluid d-block" src="https://static.pingendo.com/img-placeholder-1.svg"> </div>
                                    <div class="col-lg-3 col-6 p-3"> <img class="img-fluid d-block" src="https://static.pingendo.com/img-placeholder-1.svg"> </div>
                                    <div class="col-lg-3 col-6 p-3"> <img class="img-fluid d-block" src="https://static.pingendo.com/img-placeholder-1.svg"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<fixed-bottom
    :cancel="'{{ route('admin.posts.index') }}'"
    :route="'{{ route('admin.posts.edit', 1) }}'"
    :name="'Editar'"
></fixed-bottom>
@endsection