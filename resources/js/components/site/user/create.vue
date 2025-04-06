<template>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-9">
            <h3 style="margin: 0;">Minha conta</h3>
            <component-card
                :class-card="'mb-2'"
                :card-body="true"
                style="background: #EDEBE4;"
            >
                <template v-slot:body>
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-12" style="">
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
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="form19" class="text-dark">Sexo</label>
                                    <div class="row">
                                        <div class="col-lg-3 col-6">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="" id="flexCheckDefaultMasc">
                                                    <label class="form-check-label" for="flexCheckDefaultMasc">
                                                        Masculino
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-6">
                                            <div class="custom-control custom-radio">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="" id="flexCheckDefaultFeni">
                                                    <label class="form-check-label" for="flexCheckDefaultFeni">
                                                        Feminino
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="form19" class="text-dark">Perfil</label>
                                    <div class="form-group">
                                        <component-select :options="['Usuário', 'Cliente']" :valueSelect="''" :name-id="'role'" :placeholder="'Selecione um perfil'"></component-select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="form19" class="text-dark">E-mail</label>
                                    <component-input
                                        :required="true"
                                        :input-type="'email'"
                                        :placeholder="'email@gmail.com'"
                                        :name-id="'email'"
                                        :value="email"
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <label for="form19" class="text-dark">Senha</label>
                                    <component-input
                                        :required="true"
                                        :input-type="'password'"
                                        :name-id="'password'"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </component-card>
            <h3 >Endereço<br></h3>
            <component-card
                :class-card="'mb-2'"
                :card-body="true"
                style="background: #EDEBE4;"
            >
                <template v-slot:body>
                    <div class="row">
                        <div class="col-lg-4 col-12" style="">
                            <label for="form19" class="text-dark">CEP</label>
                            <div class="form-group"> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'00000-000'"
                                    :name-id="'postal_code'"
                                />
                                <p class=""><a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank">Não sei meu CEP</a></p>
                            </div>
                        </div>
                        <div class="col-lg-8" style="">
                            <label for="form19" class="text-dark">Endereço</label>
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'Rua, Avenida, Beco'"
                                :name-id="'street'"
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-12" style="">
                            <label for="form19" class="text-dark">Número</label>
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'45A'"
                                :name-id="'number'"
                            />
                        </div>
                        <div class="col-lg-4" style="">
                            <label for="form19" class="text-dark">Complemento</label>
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'Casa, Apt'"
                                :name-id="'complement'"
                            />
                        </div>
                        <div class="col-lg-4" style="">
                            <label for="form19" class="text-dark">Bairro</label>
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'Bairro'"
                                :name-id="'locality'"
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4" style="">
                            <label for="form19" class="text-dark">Cidade</label>
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'Cidade'"
                                :name-id="'city'"
                            />
                        </div>
                        <div class="form-group col-lg-4" style="">
                            <label for="form19" class="text-dark">Estado</label>
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'MG'"
                                :name-id="'region_code'"
                            />
                        </div>
                    </div>
                </template>
            </component-card>
        </div>
    </div>

    <div class="pb-4">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="rounded col-md-6" style="">
              <div class="row d-flex justify-content-center align-items-center">
                <div class="d-flex flex-row justify-content-center align-items-center col-md-6 col-11 pb-3">
                    <a class="btn finalizar btn-primary text-white d-flex justify-content-center btn-block rounded-sm" href="#" style="">
                        Salvar alterações
                    </a>
                </div>
                <div class="d-flex justify-content-center align-items-center col-md-6 col-11 flex-row pb-3">
                    <a class="btn btn-outline-dark d-flex justify-content-center rounded-sm btn-block border" href="#">Descartar Alterações</a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>
  
<script>
  export default {
    props: {
        email: {
            type: String,
            required: true,
        },
    },
    data() {
        return {};
    },
    methods: {}
  }
</script>
  