@extends('layouts.app')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-3" style="">
                <list-group :class-item="'list-group-flush mb-5'">
                    <list-group-item :class-item="'active'">Minha conta</list-group-item>
                    <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Seja ser um cliente?
                        </a>
                    </list-group-item>
                    <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                        Área administrativa
                    </list-group-item>
                    <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                        Assinatura
                    </list-group-item>
                    <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                        Sair
                    </list-group-item>
                </list-group>
            </div>
            <div class="col-lg-9">
                <h3 style="margin: 0;">Minha conta</h3>
                <div class="card mb-2" style="background: #EDEBE4;">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-12" style="">
                                <form action="">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="form19" class="text-dark">Nome Completo</label>
                                            <div class="form-group"> <input type="text" class="form-control" id="form14"> </div>
                                            <div class="form-group"> <small class="form-text text-muted text-right"></small></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="form19" class="text-dark">Data de Nascimento</label>
                                            <div class="form-group"> <input type="text" class="form-control" id="form14"> </div>
                                            <div class="form-group"> <small class="form-text text-muted text-right"></small></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="form19" class="text-dark">Telefone</label>
                                            <div class="form-group"> <input type="text" class="form-control" id="form14"> </div>
                                            <div class="form-group"> <small class="form-text text-muted text-right"></small> </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="form19" class="text-dark">CPF</label>
                                            <div class="form-group"> <input type="text" class="form-control" id="form14"> </div>
                                            <div class="form-group"> <small class="form-text text-muted text-right"></small></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="form19" class="text-dark">Sexo</label>
                                        <div class="col-lg-2">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Feminino
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Feminino
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="form19" class="text-dark">E-mail</label>
                                            <div class="form-group"> <input type="email" class="form-control" id="form14" placeholder="nomedapessoa@gmail.com.br" readonly=""> </div>
                                            <div class="form-group"> <small class="form-text text-muted text-right"></small> </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="form19" class="text-dark">Senha</label>
                                            <div class="form-group"> <input type="password" class="form-control" id="form14" readonly=""> </div>
                                            <div class="form-group"> <small class="form-text text-muted text-right"></small> </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 >Meus endereco<br></h3>
                <div class="card mb-2" style="background: #EDEBE4;">
                    <div class="card-body">
                      <form action="">
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
        <div class="pb-4">
            <div class="container">
              <div class="row d-flex justify-content-center">
                <div class="rounded col-md-6" style="">
                  <div class="row d-flex justify-content-center align-items-center">
                    <div class="d-flex justify-content-center align-items-center col-md-6 col-11 flex-row pb-3"><a class="btn btn-outline-dark d-flex justify-content-center rounded-sm btn-block border" href="#">Descartar Alterações</a></div>
                    <div class="d-flex flex-row justify-content-center align-items-center col-md-6 col-11 pb-3"><a class="btn finalizar btn-primary text-white d-flex justify-content-center btn-block rounded-sm" href="#" style="">Salvar alterações</a></div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<model :title="'Deseja ser um cliente?'" :name="'exampleModal'">
    Deseja ser um cliente para o público comentar sobre o seu livro, filme, série, anime até mesmo seu mangá?
    So clicar <b>Sim</b>
    <template v-slot:footer>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
        <button type="button" class="btn btn-primary">Sim</button>
    </template>
</model>
@endsection