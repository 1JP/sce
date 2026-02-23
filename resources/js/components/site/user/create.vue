<template>
    <form method="POST" :action="routeForm" ref="formUser">
        <input type="hidden" name="_token" :value="token"/>
        <input type="hidden" name="_method" value="PATCH" v-if="isUpdate"/>
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
                                <label for="form19"  class="text-body-tertiary">Nome Completo</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Nome'"
                                    :name-id="'name'"
                                    :value="name"
                                    :class-input="className"
                                    @input="inputName($event)"
                                />
                            </div>
                            <div class="col-lg-6">
                                <label for="form19"  class="text-body-tertiary">Data de Nascimento</label>
                                <component-input
                                    :required="true"
                                    :input-type="'date'"
                                    :name-id="'birth_date'"
                                    :value="birth_date"
                                    :class-input="classBirthDate"
                                    @input="inputBirthDate($event)"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="form19"  class="text-body-tertiary">Telefone</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'(31) 99999-9999'"
                                    :name-id="'phone'"
                                    :value="phone"
                                    pattern="[0-9]*"
                                    :max-length="'15'" 
                                    :class-input="classPhone"
                                    @input="inputPhone($event)"
                                />
                            </div>
                            <div class="col-lg-6">
                                <label for="form19"  class="text-body-tertiary">CPF</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'000.000.000-00'"
                                    :name-id="'cpf'"
                                    :value="cpf"
                                    :max-length="'14'"
                                    :class-input="classCpf"
                                    @input="inputCpf($event)"
                                />
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="form19"  class="text-body-tertiary">E-mail</label>
                                <component-input
                                    :required="true"
                                    :input-type="'email'"
                                    :placeholder="'email@gmail.com'"
                                    :name-id="'email'"
                                    :value="emailInput"
                                    :class-input="classEmail"
                                    @input="inputEmail($event)"
                                />
                            </div>
                            <div class="col-lg-6">
                                <label for="form19"  class="text-body-tertiary">Senha</label>
                                <component-input
                                    :required="true"
                                    :input-type="'password'"
                                    :name-id="'password'"
                                    :value="password"
                                    :class-input="classPassword"
                                    @input="inputPassword($event)"
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
                        <label for="form19"  class="text-body-tertiary">CEP</label>
                        <div class="form-group"> 
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'00000-000'"
                                :name-id="'postal_code'"
                                :value="postal_code"
                                pattern="[0-9]*"
                                :max-length="'9'"
                                :class-input="classPostalCode"
                                @input="inputPostalCode($event)"
                            />
                            <p class=""><a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank">Não sei meu CEP</a></p>
                        </div>
                    </div>
                    <div class="col-lg-8" style="">
                        <label for="form19"  class="text-body-tertiary">Endereço</label>
                        <component-input
                            :required="true"
                            :input-type="'text'"
                            :placeholder="'Rua, Avenida, Beco'"
                            :name-id="'street'"
                            :value="street"
                            :class-input="classStreet"
                            @input="inputStreet($event)"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-12" style="">
                        <label for="form19"  class="text-body-tertiary">Número</label>
                        <component-input
                            :required="true"
                            :input-type="'text'"
                            :placeholder="'45A'"
                            :name-id="'number'"
                            :value="number"
                            :class-input="classNumber"
                            @input="inputNumber($event)"
                        />
                    </div>
                    <div class="col-lg-4" style="">
                        <label for="form19"  class="text-body-tertiary">Complemento</label>
                        <component-input
                            :required="true"
                            :input-type="'text'"
                            :placeholder="'Casa, Apt'"
                            :name-id="'complement'"
                            :value="complement"
                        />
                    </div>
                    <div class="col-lg-4" style="">
                        <label for="form19"  class="text-body-tertiary">Bairro</label>
                        <component-input
                            :required="true"
                            :input-type="'text'"
                            :placeholder="'Bairro'"
                            :name-id="'locality'"
                            :value="locality"
                            :class-input="classLocality"
                            @input="inputLocality($event)"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4" style="">
                        <label for="form19"  class="text-body-tertiary">Cidade</label>
                        <component-input
                            :required="true"
                            :input-type="'text'"
                            :placeholder="'Cidade'"
                            :name-id="'city'"
                            :class-input="classCity"
                            :value="city"
                            @input="inputCity($event)"
                        />
                    </div>
                    <div class="form-group col-lg-4" style="">
                        <label for="form19"  class="text-body-tertiary">Estado</label>
                        <component-input
                            :required="true"
                            :input-type="'text'"
                            :placeholder="'MG'"
                            :name-id="'region_code'"
                            :class-input="classRegionCode"
                            :value="region_code"
                            @input="inputRegiaoCode($event)"
                        />
                    </div>
                </div>
            </template>
        </component-card>
    </form>

    <div class="pb-4">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="rounded col-md-6" style="">
              <div class="row d-flex justify-content-center align-items-center">
                <div class="d-flex flex-row justify-content-center align-items-center col-md-6 col-11 pb-3">
                    <a class="btn finalizar btn-primary text-white d-flex justify-content-center btn-block rounded-sm" href="#" style="" @click="save()">
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
                required: false,
            },
            routeForm: {
                type: String,
                required: false,
            },
            isUpdate: {
                type: Boolean,
                required: false,
                default: false
            }
        },
        data() {
            return {
                viacep: {},
                token: '',
                className: '',
                classBirthDate: '',
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
                emailInput: '',
                password: '',
                postal_code: '',
                street: '',
                number: '',
                locality: '',
                city: '',
                region_code: '',
                complement: '',
            };
        },
        methods: {
            async getAddressByCep (cep) {
                if (cep.length >= 9) {
                    let fixedCep = cep.replace('-', '')
                    await axios.get(`https://viacep.com.br/ws/${fixedCep}/json/`)
                        .then(response => this.viacep = response.data)
                        .catch(function(error) {
                            console.log(error.request)
                        })

                    if(Object.keys(this.viacep).length > 0){
                        this.street = this.viacep.logradouro;
                        this.city = this.viacep.localidade;
                        this.locality = this.viacep.bairro;
                        this.state = this.viacep.uf;
                    }
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
            inputName(event){
                this.name = event.target.value;
            },
            inputBirthDate(event){
                this.birth_date = event.target.value;
            },
            inputPhone(event){
                if(/^[a-zA-Z]$/.test(event.target.value)){
                    this.phone = null;
                    return;
                }
                this.phone = this.maskPhoneNumber(event.target.value);
            },
            inputCpf(event){
                event.target.value = event.target.value.replace(/\D/g, '');
                this.cpf = this.maskCpf(event.target.value);
            },
            inputEmail(event){
                this.email = event.target.value
            },
            inputPassword(event){
                this.password = event.target.value
            },
            inputPostalCode(event){
                event.target.value = event.target.value.replace(/\D/g, '');
                this.postal_code = this.maskCep(event.target.value);
                this.getAddressByCep(this.postal_code);
            },
            inputStreet(event){
                this.street = event.target.value
            },
            inputNumber(event){
                this.number = event.target.value
            },
            inputLocality(event){
                this.locality = event.target.value
            },
            inputCity(event){
                this.city = event.target.value
            },
            inputRegiaoCode(event){
                this.region_code = event.target.value
            },
            checkEmptyFields() {
                if(this.birth_date == '' || this.name == '' || this.phone == '' ||
                 this.cpf == '' || this.emailInput == '' || (!this.isUpdate && this.password === '') ||
                 this.postal_code == '' || this.street == '' || this.number == '' ||
                 this.locality == '' || this.city == '' || this.region_code == ''){
                    this.className = this.name == '' ? 'is-invalid' : 'is-valid'
                    this.classBirthDate = this.birth_date == '' ? 'is-invalid' : 'is-valid'
                    this.classPhone = this.phone == '' ? 'is-invalid' : 'is-valid'
                    this.classCpf = this.cpf == '' ? 'is-invalid' : 'is-valid'
                    this.classEmail = this.emailInput == '' ? 'is-invalid' : 'is-valid'
                    this.classPassword = this.password == '' ? 'is-invalid' : 'is-valid'
                    this.classPostalCode = this.postal_code == '' ? 'is-invalid' : 'is-valid'
                    this.classStreet = this.street == '' ? 'is-invalid' : 'is-valid'
                    this.classNumber = this.number == '' ? 'is-invalid' : 'is-valid'
                    this.classLocality = this.locality == '' ? 'is-invalid' : 'is-valid'
                    this.classCity = this.city == '' ? 'is-invalid' : 'is-valid'
                    this.classRegionCode = this.region_code == '' ? 'is-invalid' : 'is-valid'
                    return true;
                }

                this.classInput = 'is-valid'
                this.classBirthDate = 'is-valid'
                this.classPhone = 'is-valid'
                this.classCpf = 'is-valid'
                this.classEmail = 'is-valid'
                if (!this.isUpdate) {
                    this.classPassword = 'is-valid'
                }
                this.classPostalCode = 'is-valid'
                this.classStreet = 'is-valid'
                this.classLocality = 'is-valid'
                this.classCity = 'is-valid'
                this.classRegionCode = 'is-valid'
                this.classNumber = 'is-valid'

                return false;
            },
            save(){
                if(this.checkEmptyFields()) return;
                
                this.$refs.formUser.submit();
            },
            getUser(){
                if(this.isUpdate){
                    const params = new URLSearchParams(this.routeForm)
                    const url = Object.keys(Object.fromEntries(params.entries()))[0]
                    let id = url.substring(url.lastIndexOf('?') + 1)
                    axios.get(route('api.users.show', id))
                        .then((response) => {
                            this.birth_date = response.data.data.birth_date;
                            this.name = response.data.data.name;
                            this.phone = response.data.data.area+response.data.data.phone;
                            this.cpf = response.data.data.cpf;
                            this.emailInput = response.data.data.email;
                            this.postal_code = response.data.data.postal_code;
                            this.street = response.data.data.street;
                            this.number = response.data.data.number;
                            this.locality = response.data.data.locality;
                            this.city = response.data.data.city;
                            this.region_code = response.data.data.region_code;
                            this.complement = response.data.data.complement
                        })
                }
            }
        },
        mounted() {
            this.emailInput = this.email
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
            this.getUser();
        }
    }
</script>
  