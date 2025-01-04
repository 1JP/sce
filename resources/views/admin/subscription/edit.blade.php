@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Assinatura" , "route" => route("admin.assinaturas.index") ],
        [ "name" => "Editar Assinatura"]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <h6 class="mb-0">Assinatura</h6>
                        </div>
                        <div class="col-lg-8 d-flex justify-content-end">
                            <a href="{{ route('admin.assinaturas.index') }}" class="btn bg-gradient-primary">
                                Voltar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-xl-12">
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
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="form-row">
                            <div class="form-group col-lg-12" style="">
                                <label>Plano *</label>
                                <select class="form-control">
                                    <option selected="" value="">Selecione o plano</option>
                                </select>
                            </div>
                        </div>
                        <form class="text-left">
                            <div class="row">
                              <div class="form-group col-lg-6"> 
                                <label for="form19">Número do cartão *</label> 
                                <input type="text" class="form-control text-left" id="form19" placeholder="1234 5678 9012 3456"> </div>
                              <div class="form-group col-lg-6"> <label for="form20">Nome do titular do cartão *</label> <input type="text" class="form-control text-left" id="form19" placeholder="Ex: José da Silva"> </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-lg-4"><label>Data de validade *</label>
                                <select class="form-control ">
                                  <option selected="" value="Selecione...">Mês...</option>
                                  <option value="1">01</option>
                                  <option value="2">02</option>
                                  <option value="3">03</option>
                                  <option value="4">04</option>
                                  <option value="5">05</option>
                                  <option value="6">06</option>
                                  <option value="7">07</option>
                                  <option value="8">08</option>
                                  <option value="9">09</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                                </select>
                              </div>
                              <div class="form-group col-lg-4"><label>&nbsp;</label>
                                <select class="form-control ">
                                  <option selected="" value="Selecione...">Ano...</option>
                                  <option value="1">22</option>
                                  <option value="2">23</option>
                                  <option value="3">24</option>
                                  <option value="4">25</option>
                                  <option value="5">26</option>
                                  <option value="6">27</option>
                                  <option value="7">28</option>
                                  <option value="8">29</option>
                                  <option value="9">30</option>
                                  <option value="10">31</option>
                                  <option value="11">32</option>
                                  <option value="12">33</option>
                                  <option value="5">34</option>
                                  <option value="6">35</option>
                                  <option value="7">28</option>
                                  <option value="8">29</option>
                                  <option value="9">30</option>
                                  <option value="10">31</option>
                                  <option value="11">32</option>
                                  <option value="12">33</option>
                                </select>
                              </div>
                              <div class="form-group col-lg-4"> <label for="form19">CVV</label> <input type="text" class="form-control text-left" id="form19" placeholder="Ex: 123"> </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-4 col-12" style="">
                                <label for="form19" class="text-dark">CEP</label>
                                <div class="form-group">
                                    <div class="form-group"> <input type="text" class="form-control" id="form14">
                                    <p class=""><a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank">Não sei meu CEP</a></p>
                                    </div>
                                </div>
                                <div class="form-group"> <small class="form-text text-muted text-right"></small> </div>
                                </div>
                                <div class="form-group col-lg-6" style="">
                                    <label for="form19" class="text-dark">Endereço</label>
                                    <input type="text" class="form-control" id="form14">
                                    <small class="form-text text-muted text-right"></small>
                                </div>
                                <div class="form-group col-lg-3 col-12" style="">
                                    <label for="form19" class="text-dark">Número</label>
                                    <input type="text" class="form-control" id="form14">
                                    <small class="form-text text-muted text-right"></small>
                                </div>
                                <div class="form-group col-lg-4" style="">
                                    <label for="form19" class="text-dark">Complemento</label>
                                    <input type="text" class="form-control" id="form14">
                                    <small class="form-text text-muted text-right"></small>
                                </div>
                                <div class="form-group col-lg-4" style="">
                                    <label for="form19" class="text-dark">Bairro</label>
                                    <input type="text" class="form-control" id="form14">
                                    <small class="form-text text-muted text-right"></small>
                                </div>
                                <div class="form-group col-lg-4" style="">
                                    <label for="form19" class="text-dark">Cidade</label>
                                    <input type="text" class="form-control" id="form14">
                                    <small class="form-text text-muted text-right"></small>
                                </div>
                                <div class="form-group col-lg-4" style="">
                                    <label for="form19" class="text-dark">Estado</label>
                                    <input type="text" class="form-control" id="form14">
                                    <small class="form-text text-muted text-right"></small>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<fixed-bottom
    :cancel="'{{ route('admin.assinaturas.index') }}'"
    :name="'Editar assinatura'"
></fixed-bottom>
@endsection