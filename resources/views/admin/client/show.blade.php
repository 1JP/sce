@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Clientes", "route" => route("admin.clientes.index") ],
        [ "name" => "Visualizar Cliente"]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8">
            <component-card
                :card-body="true"
            >
                <template v-slot:body>
                    <p class="text-uppercase text-sm">Cliente</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6 class="my-0">Nome</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6 class="my-0">Usúario</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6 class="my-0">Data de nascimento</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6 class="my-0">CPF</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6 class="my-0">Telefone</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Endereço</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h6 class="my-0">Endereço</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6 class="my-0">Cidade</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6 class="my-0">Bairro</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6 class="my-0">CEP</h6>
                                <small class="text-muted">35750-000</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6 class="my-0">Número</h6>
                                <small class="text-muted">35</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6 class="my-0">Complemento</h6>
                                <small class="text-muted">35</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h6 class="my-0">Estado</h6>
                                <small class="text-muted">35</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 d-flex p-3 ml-auto justify-content-end align-items-center flex-row">
                                <a href="{{ route('admin.clientes.index') }}" class="btn bg-gradient-primary m-1">
                                    Voltar
                                </a>
                                
                                <a href="{{ route('admin.clientes.edit', 1) }}" class="btn bg-gradient-info m-1">
                                    Editar
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
            </component-card>
        </div>
        <div class="col-md-4">
            <component-card
                :class-card="'card-profile'"
                :card-body="true"
                :card-header="true"
                :class-header="'text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3'"
                :class-body="'pt-0'"
            >
                <template v-slot:body>
                    <div class="row">
                        <div class="col">
                          <div class="d-flex justify-content-center">
                            <div class="d-grid text-center">
                              <span class="text-lg font-weight-bolder">22</span>
                              <span class="text-sm opacity-8">Posts</span>
                            </div>
                            <div class="d-grid text-center mx-4">
                              <span class="text-lg font-weight-bolder">10</span>
                              <span class="text-sm opacity-8">Liks</span>
                            </div>
                            <div class="d-grid text-center mx-4">
                              <span class="text-lg font-weight-bolder">89</span>
                              <span class="text-sm opacity-8">Deslink</span>
                            </div>
                            <div class="d-grid text-center">
                              <span class="text-lg font-weight-bolder">89</span>
                              <span class="text-sm opacity-8">Comentarios</span>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <component-card
                                    :card-header="true"
                                    :class-header="'mx-4 p-3 text-center'"
                                    :card-body="true"
                                    :class-body="'pt-0 p-3 text-center'"
                                >
                                    <template v-slot:header>
                                        <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="fa fa-book opacity-10"></i>
                                        </div>
                                    </template>
                                    <template v-slot:body>
                                        <h6 class="text-center mb-0">Plano</h6>
                                        <span class="text-xs">Belong Interactive</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">Ativo</h5>
                                    </template>
                                </component-card>
                            </div>
                            <div class="col-lg-6">
                                <component-card
                                    :card-header="true"
                                    :class-header="'mx-4 p-3 text-center'"
                                    :card-body="true"
                                    :class-body="'pt-0 p-3 text-center'"
                                >
                                    <template v-slot:header>
                                        <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="ni ni-credit-card opacity-10"></i>
                                        </div>
                                    </template>
                                    <template v-slot:body>
                                        <h6 class="text-center mb-0">Assinatura</h6>
                                        <span class="text-xs">Freelance Payment</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">$455.00</h5>
                                    </template>
                                </component-card>
                            </div>
                        </div>
                    </div>
                </template>
            </component-card>
        </div>
    </div>
</div>
@endsection