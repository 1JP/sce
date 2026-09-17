<template>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <component-card
                    :card-body="true"
                >
                    <template v-slot:body>
                        <form :action="route('admin.clientes.update', client.id)" method="POST" ref="formEdit">
                            <input type="hidden" name="_token" :value="token"/>
                            <input type="hidden" name="_method" value="PATCH"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nome</label>
                                        <component-input
                                            :required="true"
                                            :input-type="'text'"
                                            :placeholder="'Jose da Silva'"
                                            :name-id="'name'"
                                            :value="name"
                                            :class-input="className"
                                            @input="inputName($event)"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Usúario</label>
                                        <component-input
                                            :required="true"
                                            :input-type="'text'"
                                            :placeholder="'Jose da Silva'"
                                            :name-id="'username'"
                                            :value="userName"
                                            :class-input="classUserName"
                                            @input="inputUserName($event)"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Data de nascimento</label>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">CPF</label>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Telefone</label>
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
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Endereço</p>
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12 d-flex p-3 ml-auto justify-content-end align-items-center flex-row">
                                            <button type="button" class="btn bg-gradient-info m-1" @click="save()">
                                                Editar
                                            </button>
                                            <a :href="route('admin.clientes.show', client.id)" class="btn bg-gradient-secondary m-1">
                                                Visualizar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </template>
                </component-card>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            client: {
                type: Object
            },
            user: {
                type: Object
            },
        },
        data(){
            return {
                viacep: {},
                token: '',
                classBirthDate: '',
                classCpf: '',
                classPhone: '',
                classPostalCode: '',
                classStreet: '',
                classNumber: '',
                classLocality: '',
                classCity: '',
                classRegionCode: '',
                classPlan: '',
                className: '',
                classUserName: '',
                cpf: '',
                postal_code: '',
                street: '',
                number: '',
                locality: '',
                phone: '',
                city: '',
                region_code: '',
                complement: '',
                name: '',
                userName: '',
                birth_date: ''
            }
        },
        methods: {
            async getAddressByCep (cep) {
                if (cep.length >= 9) {
                    let fixedCep = cep.replace('-', '')
                    await axios.get(route('api.viacep.getAddressByCep', fixedCep))
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
            inputCpf(event){
                event.target.value = event.target.value.replace(/\D/g, '');
                this.cpf = this.maskCpf(event.target.value);
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
            inputPhone(event){
                if(/^[a-zA-Z]$/.test(event.target.value)){
                    this.phone = null;
                    return;
                }
                this.phone = this.maskPhoneNumber(event.target.value);
            },
            inputName(event){
                this.name = event.target.value;
            },
            inputUserName(){
                this.userName = event.target.value;
            },
            inputBirthDate(event){
                this.birth_date = event.target.value;
            },
            inputCpf(event){
                event.target.value = event.target.value.replace(/\D/g, '');
                this.cpf = this.maskCpf(event.target.value);
            },
            checkEmptyFields() {
                if(this.name == '' || this.cpf == '' || this.userName == '' ||
                 this.postal_code == '' || this.street == '' || this.number == '' ||
                 this.locality == '' || this.city == '' || this.region_code == '' || this.birth_date == ''){
                    this.className = this.name == '' ? 'is-invalid' : 'is-valid'
                    this.classBirthDate = this.birth_date == '' ? 'is-invalid' : 'is-valid'
                    this.classCpf = this.cpf == '' ? 'is-invalid' : 'is-valid'
                    this.classPostalCode = this.postal_code == '' ? 'is-invalid' : 'is-valid'
                    this.classStreet = this.street == '' ? 'is-invalid' : 'is-valid'
                    this.classNumber = this.number == '' ? 'is-invalid' : 'is-valid'
                    this.classLocality = this.locality == '' ? 'is-invalid' : 'is-valid'
                    this.classCity = this.city == '' ? 'is-invalid' : 'is-valid'
                    this.classRegionCode = this.region_code == '' ? 'is-invalid' : 'is-valid'
                    this.classPhone = this.phone == '' ? 'is-invalid' : 'is-valid';
                    this.classUserName = this.userName == '' ? 'is-invalid' : 'is-valid';

                    return true;
                }

                this.className = 'is-valid'
                this.classPhone = 'is-valid'
                this.classCpf = 'is-valid'
                this.classPostalCode = 'is-valid'
                this.classStreet = 'is-valid'
                this.classLocality = 'is-valid'
                this.classCity = 'is-valid'
                this.classRegionCode = 'is-valid'
                this.classNumber = 'is-valid'
                this.classBirthDate = 'is-valid'
                this.classUserName = 'is-valid'

                return false;
            },
            save(){
                if(this.checkEmptyFields()) return;
                this.$refs.formEdit.submit();
            }
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
            this.cpf = this.maskCpf(this.client.cpf),
            this.postal_code = this.maskCep(this.client.postal_code),
            this.street = this.client.street,
            this.number = this.client.number,
            this.locality = this.client.locality,
            this.phone = this.maskPhoneNumber(this.client.area+this.client.phone),
            this.city = this.client.city,
            this.region_code = this.client.region_code,
            this.complement = this.client.complement,
            this.name = this.client.name,
            this.userName = this.user.name
            this.birth_date = this.client.birth_date
        }
    }
</script>