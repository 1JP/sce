@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-9">
            <h3 style="margin: 0;">Minha conta</h3>
            <site-create-user :email="'{{ $email }}'">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-12" style="">
                        <form action="">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="form19" class="text-dark">Nome Completo</label>
                                    <component-input
                                        :required="true"
                                        :input-type="'text'"
                                        :placeholder="'Nome'"
                                        :name-id="'name'"
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <label for="form19" class="text-dark">Data de Nascimento</label>
                                    <component-input
                                        :required="true"
                                        :input-type="'date'"
                                        :name-id="'birth_date'"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="form19" class="text-dark">Telefone</label>
                                    <component-input
                                        :required="true"
                                        :input-type="'text'"
                                        :placeholder="'(31) 99999-9999'"
                                        :name-id="'phone'"
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <label for="form19" class="text-dark">CPF</label>
                                    <component-input
                                        :required="true"
                                        :input-type="'text'"
                                        :placeholder="'000.000.000-00'"
                                        :name-id="'document'"
                                    />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </site-create-user>
        </div>
    </div>
    
    <div class="pb-4">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="rounded col-md-6" style="">
              <div class="row d-flex justify-content-center align-items-center">
                <div class="d-flex justify-content-center align-items-center col-md-6 col-11 flex-row pb-3">
                    <a class="btn btn-outline-dark d-flex justify-content-center rounded-sm btn-block border" href="#">Descartar Alterações</a>
                </div>
                <div class="d-flex flex-row justify-content-center align-items-center col-md-6 col-11 pb-3">
                    <a class="btn finalizar btn-primary text-white d-flex justify-content-center btn-block rounded-sm" href="#" style="">
                        Salvar alterações
                    </a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection