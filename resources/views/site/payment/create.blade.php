@extends('layouts.app')

@section('content')
<div class="text-center">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6 col-10 py-2 py-lg-0 order-2 order-md-1">
          <form class="text-left">
            <div class="card" style="background: rgb(237, 235, 228);">
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-lg-12" style="">
                    <label class="text-body-tertiary">Plano *</label>
                    <select class="form-control ">
                        <option selected="" value="Selecione...">Selecione o plano</option>
                        <option value="1">01 vez</option>
                        <option value="2">02 vezes (sem juros)</option>
                        <option value="3">03 vezes (sem juros)</option>
                        <option value="4">04 vezes (sem juros)</option>
                        <option value="5">05 vezes (sem juros)</option>
                        <option value="6">06 vezes (sem juros)</option>
                        <option value="7">07 vezes (sem juros)</option>
                        <option value="8">08 vezes (sem juros)</option>
                        <option value="9">09 vezes (sem juros)</option>
                        <option value="10">10 vezes (sem juros)</option>
                        <option value="11">11 vezes (sem juros)</option>
                        <option value="12">12 vezes (sem juros)</option>
                    </select>
                  </div>
                  <h3 class="mb-4 pb-4">Pagamento</h3>
                    <div class="row">
                      <div class="form-group col-lg-6"> <label class="text-body-tertiary">Número do cartão *</label> <input type="text" class="form-control text-left" id="form19" placeholder="Ex: 1234 5678 9012 3456"> </div>
                      <div class="form-group col-lg-6"> <label class="text-body-tertiary">Nome do titular do cartão *</label> <input type="text" class="form-control text-left" id="form19" placeholder="Ex: José da Silva"> </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-4"><label class="text-body-tertiary">Data de validade *</label>
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
                      <div class="form-group col-lg-4"><label class="text-body-tertiary">&nbsp;</label>
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
                      <div class="form-group col-lg-4"> <label class="text-body-tertiary">CVV</label> <input type="text" class="form-control text-left" id="form19" placeholder="Ex: 123"> </div>
                    </div>
                    <h3 class="mb-4 pb-4">Endereço</h3>
                    <div class="row">
                        <div class="form-group col-lg-4 col-12" style="">
                        <label class="text-body-tertiary">CEP</label>
                        <div class="form-group">
                            <div class="form-group"> <input type="text" class="form-control" id="form14">
                            <p class=""><a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank">Não sei meu CEP</a></p>
                            </div>
                        </div>
                        <div class="form-group"> <small class="form-text text-muted text-right"></small> </div>
                        </div>
                        <div class="form-group col-lg-8" style="">
                            <label class="text-body-tertiary">Endereço</label>
                            <input type="text" class="form-control" id="form14">
                            <small class="form-text text-muted text-right"></small>
                        </div>
                        <div class="form-group col-lg-3 col-12" style="">
                            <label class="text-body-tertiary">Número</label>
                            <input type="text" class="form-control" id="form14">
                            <small class="form-text text-muted text-right"></small>
                        </div>
                        <div class="form-group col-lg-4" style="">
                            <label class="text-body-tertiary">Complemento</label>
                            <input type="text" class="form-control" id="form14">
                            <small class="form-text text-muted text-right"></small>
                        </div>
                        <div class="form-group col-lg-4" style="">
                            <label class="text-body-tertiary">Bairro</label>
                            <input type="text" class="form-control" id="form14">
                            <small class="form-text text-muted text-right"></small>
                        </div>
                        <div class="form-group col-lg-4" style="">
                            <label class="text-body-tertiary">Cidade</label>
                            <input type="text" class="form-control" id="form14">
                            <small class="form-text text-muted text-right"></small>
                        </div>
                        <div class="form-group col-lg-4" style="">
                            <label class="text-body-tertiary">Estado</label>
                            <input type="text" class="form-control" id="form14">
                            <small class="form-text text-muted text-right"></small>
                        </div>
                    </div>
                    <button type='submit' class="btn btn-primary btn-block rounded w-100" >Criar assinatura</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-4 col-10 order-1 order-md-2">
          <div class="card mb-2" style="background: rgb(237, 235, 228);">
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-lg-12" style="">
                  <label class="text-body-tertiary">Plano</label>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-lg-12" style="">
                  <p>No entanto, não podemos esquecer que o acompanhamento das preferências de consumo representa uma abertura para a melhoria das regras de conduta normativas.</p>
                </div>
              </div>
              <div class="row mx-auto d-flex align-items-start justify-content-between">
                <div class="px-0 col-9 col-lg-10" style="">
                  <div class="row">
                    <div class="col-6 col-lg-6">
                      <label class="text-body-tertiary">Filme</label>
                    </div>
                    <div class="col-6 col-lg-6">
                      <h4 class="card-title text-right"><span style="font-weight: normal;">Qtd: 1</span></h4>
                    </div>
                  </div>
                </div>
                <div class="px-0 col-9 col-lg-10" style="">
                  <div class="row">
                    <div class="col-6 col-lg-6">
                      <label class="text-body-tertiary">Livro</label>
                    </div>
                    <div class="col-6 col-lg-6">
                      <h4 class="card-title text-right"><span style="font-weight: normal;">Qtd: 1</span></h4>
                    </div>
                  </div>
                </div>
                <div class="px-0 col-9 col-lg-10" style="">
                  <div class="row">
                    <div class="col-6 col-lg-6">
                      <label class="text-body-tertiary">Serie</label>
                    </div>
                    <div class="col-6 col-lg-6">
                      <h4 class="card-title text-right"><span style="font-weight: normal;">Qtd: 1</span></h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mx-auto">
                <div class="text-dark bg-grey col-12 ml-auto col-lg-12">
                  <div class="row">
                    <div class="col-md-12 d-flex justify-content-between px-0 pt-2 pb-0">
                      <h4 class="card-title text-body-tertiary my-0">Total</h4>
                      <h3 class="card-title my-0">R$ 307,00</h3>
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
@endsection