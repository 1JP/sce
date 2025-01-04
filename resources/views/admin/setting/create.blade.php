@extends('layouts.admin-app')

@section('breadcrumb')
    <breadcrumb :items='@json([
        [ "name" => "Configurações" ]
    ])'></breadcrumb>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row text-left">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12" style="">
                    <component-card
                        :card-body="true"
                    >
                        <template v-slot:body>
                            <div class="row mx-auto">
                                <div class="col-md-12">
                                  <h5>Endereço</h5>
                                </div>
                            </div>
                            <div class="row mx-auto">
                                <div class="col-md-12">
                                    <form class="">
                                        <div class="row mt-2">
                                        <div class="form-group col-md-4"> <label for="form19">CEP*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        <div class="form-group col-md-8"> <label for="form19">Endereço*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        </div>
                                        <div class="row mt-2">
                                        <div class="form-group col-md-4"> <label for="form19">Número*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        <div class="form-group col-md-4"> <label for="form19">Complemento*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        <div class="form-group col-md-4"> <label for="form19">Bairro*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        </div>
                                        <div class="row mt-2 pb-2">
                                        <div class="form-group col-md-4"> <label for="form19">Cidade*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        <div class="form-group col-md-4"> <label for="form19">Estado*</label> <input type="search" class="form-control" id="form19" required="required"> </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mx-3 mt-2">
                                <div class="col-md-12 px-0">
                                  <div class="col-md-12 col-7 pl-0">
                                  </div>
                                </div>
                            </div>
                            <div class="row mx-3">
                                <b>
                                </b>
                            </div>
                            <div class="row mx-auto">
                                <div class="col-md-12 border-bottom">
                                  <h5>Informações gerais do site</h5>
                                  <div class="row mt-2">
                                    <div class="form-group col-md-12"> <label for="form19">Descrição</label>
                                      <div class="form-group"><textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea></div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="row mx-auto pt-2">
                                <div class="col-md-12 py-2">
                                    <h5>Informações da empresa</h5>
                                    <div class="row mt-2 pb-2">
                                        <div class="form-group col-md-6"> <label for="form19">Razão Social*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        <div class="form-group col-md-6"> <label for="form19">CNPJ*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        <div class="form-group col-md-6"> <label for="form19">E-mail*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
        
                                        <div class="form-group col-md-6"> <label for="form19">Facebook*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        <div class="form-group col-md-6"> <label for="form19">Twitter*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        <div class="form-group col-md-6"> <label for="form19">Youtube*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        <div class="form-group col-md-6"> <label for="form19">Instagram*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-auto pt-2">
                                <div class="col-md-12 py-2">
                                    <h5>Informações da API de pagamento</h5>
                                    <div class="row mt-2 pb-2">
                                        <div class="form-group col-md-6"> <label for="form19">URL produção*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        <div class="form-group col-md-6"> <label for="form19">URL sandbox*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
        
                                        <div class="form-group col-md-12"> <label for="form19">Token*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                        <div class="form-group col-md-12"> <label for="form19">Publico de Token*</label> <input type="text" class="form-control" id="form19" required="required"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 d-flex p-3 ml-auto justify-content-end align-items-center flex-row">
                                  <a class="btn btn-outline-primary m-1" href="#">Cancelar</a>
                                  <a class="btn btn-primary m-1" href="#">Salvar alterações</a>
                                </div>
                            </div>
                        </template>
                    </component-card>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection