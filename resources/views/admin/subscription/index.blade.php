@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Assinatura" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Assinatura</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <h6 class="mb-0">Faturas</h6>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a href="#" class="btn btn-outline-primary btn-sm mb-0">Ver tudo</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3 pb-0">
                                    <list-group>
                                        <list-group-item :class-item="'border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg'">
                                            <admin-subscription-info
                                                :value="'200,00'"
                                                :id="'1'"
                                                :date="'03 de janeiro de 2025'"
                                                :route="'#'"
                                            ></admin-subscription-info>
                                        </list-group-item>
                                        <list-group-item :class-item="'border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg'">
                                            <admin-subscription-info
                                                :value="'200,00'"
                                                :id="'1'"
                                                :date="'03 de janeiro de 2025'"
                                                :route="'#'"
                                            ></admin-subscription-info>
                                        </list-group-item>
                                    </list-group>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-md-4">
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
                                        
                                        <div class="col-md-4 mt-md-0 mt-4">
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
                                        <div class="col-md-4">
                                            <component-card
                                                :card-header="true"
                                                :class-header="'mx-4 p-3 text-center'"
                                            >
                                                <template v-slot:header>
                                                    <button type="button" class="btn bg-gradient-danger btn-block mb-3" data-bs-toggle="modal" data-bs-target="#destorySubscription">
                                                        Excluir Assinatura
                                                    </button>
                                                    <hr class="horizontal dark my-3">
                                                    <a href="#" class="btn bg-gradient-info btn-block mb-3">
                                                        Editar Assinatura
                                                    </a>
                                                </template>
                                            </component-card>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<model :title="'Excluir Assinatura'" :name="'destorySubscription'">
    <div class="py-3 text-center">
        <i class="ni ni-bell-55 ni-3x"></i>
        <h4 class="text-gradient text-danger mt-4">Deseja excluir essa assinatura?</h4>
        <p>Todos os posts relacionados a essa assinatura será excluidos também</p>
    </div>
    <template v-slot:footer>
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-danger">Excluir</button>
    </template>
</model>

@endsection