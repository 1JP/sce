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
                                        :value="name"
                                        :class-input="className"
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <label for="form19" class="text-dark">Data de Nascimento</label>
                                    <component-input
                                        :required="true"
                                        :input-type="'date'"
                                        :name-id="'birth_date'"
                                        :value="birth_date"
                                        :class-input="classBithDate"
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
                                        :value="phone"
                                        :class-input="classPhone"
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <label for="form19" class="text-dark">CPF</label>
                                    <component-input
                                        :required="true"
                                        :input-type="'text'"
                                        :placeholder="'000.000.000-00'"
                                        :name-id="'cpf'"
                                        :value="cpf"
                                        :class-input="classCpf"
                                    />
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
                                        :class-input="classEmail"
                                    />
                                </div>
                                <div class="col-lg-6">
                                    <label for="form19" class="text-dark">Senha</label>
                                    <component-input
                                        :required="true"
                                        :input-type="'password'"
                                        :name-id="'password'"
                                        :value="password"
                                        :class-input="classPassword"
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
                                    :value="postal_code"
                                    pattern="[0-9]*"
                                    :class-input="classPostalCode"
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
                                :value="street"
                                :class-input="classStreet"
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
                                :value="number"
                                :class-input="classNumber"
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
                                :value="locality"
                                :class-input="classLocality"
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
                                :class-input="classCity"
                                :value="city"
                            />
                        </div>
                        <div class="form-group col-lg-4" style="">
                            <label for="form19" class="text-dark">Estado</label>
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'MG'"
                                :name-id="'region_code'"
                                :class-input="classRegionCode"
                                :value="region_code"
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
    import axios from 'axios';

    export default {
        props: {
            email: {
                type: String,
                required: true,
            },
        },
        data() {
            return {
                viacep: {},
                token: '',
                className: '',
                classBithDate: '',
                classPhone: '',
                classCpf: '',
                classEmail: '',
                classPassword: '',
                classPostalCode: '',
                classStreet: '',
                classNumber: '',
                classLocality: '',
                classCity: '',
                classRegionCode: '',
                birth_date: '',
                name: '',
                phone: '',
                cpf: '',
                email: email,
                password: '',
                postal_code: '',
                street: '',
                number: '',
                locality: '',
                city: '',
                region_code: ''
            };
        },
        methods: {
            async getAddressByCep (cep) {
                if (cep.length >= 9) {
                    let fixedCep = cep.replace('-', '')
                    await axios.get(`https://viacep.com.br/ws/${fixedCep}/json/`)
                        .then(response => this.viacep = response.data);

                    this.street = this.viacep.logradouro;
                    this.city = this.viacep.localidade;
                    this.locality = this.viacep.bairro;
                    this.state = this.viacep.uf;
                }
            },
            maskCep(string){
                string = string.replace(/\D/g, '');
                if(string.length > 5){
                    string = string.replace(/^(\d{5})(\d{1,3})?$/, '$1-$2');
                }

                return string;
            },
            maskCpf(string){
                string = string.replace(/\D/g, '');
                if (string.length > 3 && string.length <= 6) {
                    string = string.replace(/^(\d{3})(\d)/, '$1.$2');
                } else if (string.length > 6 && string.length <= 9) {
                    string = string.replace(/^(\d{3})(\d{3})(\d)/, '$1.$2.$3');
                } else if (string.length > 9 && string.length <= 11) {
                    string = string.replace(/^(\d{3})(\d{3})(\d{3})(\d)/, '$1.$2.$3-$4');
                }

                return string;
            },
            maskPhoneNumber(string){
                string = string.replace(/\D/g, '');
                if (string.length === 11) {
                    string = string.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
                } else {
                    string = string.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
                }

                return string;
            },
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>
  