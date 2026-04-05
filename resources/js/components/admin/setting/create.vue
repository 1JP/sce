<template>
    <component-card
        :card-body="true"
    >
        <template v-slot:body>
            <form class="" method="POST" ref="form" :action="route('admin.configuracoes.store')">
                <input type="hidden" name="_token" :value="token"/>
                <div class="row mx-auto">
                    <div class="col-md-12">
                        <h5>Endereço</h5>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-md-12">
                        <div class="row mt-2">
                            <div class="form-group col-md-4"> 
                                <label for="form19">CEP*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'CEP'"
                                    :name-id="'address[cep]'"
                                    :value="address.cep"
                                    :class-input="classAddressCep"
                                    @input="inputPostalCode($event)"
                                    :max-length="9"
                                />
                            </div>
                            <div class="form-group col-md-8"> 
                                <label for="form19">Endereço*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Endereço'"
                                    :name-id="'address[street]'"
                                    :value="address.street"
                                    :class-input="classAddressStreet"
                                    @input="inputAddressStreet($event)"
                                />  
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="form-group col-md-4"> 
                                <label for="form19">Número*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Número'"
                                    :name-id="'address[number]'"
                                    :value="address.number"
                                    :class-input="classAddressNumber"
                                    @input="inputAddressNumber($event)"
                                />  
                            </div>
                            <div class="form-group col-md-4"> 
                                <label for="form19">Complemento</label> 
                                <component-input
                                    :input-type="'text'"
                                    :placeholder="'Complemento'"
                                    :name-id="'address[complement]'"
                                    :value="address.complement"
                                    :class-input="classAddressComplement"
                                    @input="inputAddressComplement($event)"
                                />  
                            </div>
                            <div class="form-group col-md-4"> 
                                <label for="form19">Bairro*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Bairro'"
                                    :name-id="'address[neighborhood]'"
                                    :value="address.neighborhood"
                                    :class-input="classAddressNeighborhood"
                                    @input="inputAddressNeighborhood($event)"
                                /> 
                            </div>
                        </div>
                        <div class="row mt-2 pb-2">
                            <div class="form-group col-md-4"> 
                                <label for="form19">Cidade*</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Cidade'"
                                    :name-id="'address[city]'"
                                    :value="address.city"
                                    :class-input="classAddressCity"
                                    @input="inputAddressCity($event)"
                                />
                            </div>
                            <div class="form-group col-md-4"> 
                                <label for="form19">Estado*</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Estado'"
                                    :name-id="'address[state]'"
                                    :value="address.state"
                                    :class-input="classAddressState"
                                    :max-length="2"
                                    @input="inputAddressState($event)"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-md-12 border-bottom">
                        <h5>Informações gerais do site</h5>
                        <div class="row mt-2">
                            <div class="form-group col-md-12"> 
                                <label for="form19">Descrição</label>
                                <div class="form-group">
                                    <component-text-area
                                        :is-required="true"
                                        :placeholder="'Descrição'"
                                        :name-id="'site[description]'"
                                        :value="site.description"
                                        :class-input="classDescription"
                                        @input="textAreaDescription($event)"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-auto pt-2">
                    <div class="col-md-12 py-2">
                        <h5>Informações da empresa</h5>
                        <div class="row mt-2 pb-2">
                            <div class="form-group col-md-6"> 
                                <label for="form19">Razão Social*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Razão Social'"
                                    :name-id="'company[name]'"
                                    :value="company.name"
                                    :class-input="classCompanyName"
                                    @input="inputCompanyName($event)"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">CNPJ*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'CNPJ'"
                                    :name-id="'company[cnpj]'"
                                    :value="company.cnpj"
                                    :class-input="classCompanyCnpj"
                                    @input="inputCompanyCnpj($event)"
                                    :max-length="18"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">E-mail*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'email'"
                                    :placeholder="'E-mail'"
                                    :name-id="'company[email]'"
                                    :value="company.email"
                                    :class-input="classCompanyEmail"
                                    @input="inputCompanyEmail($event)"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">Facebook</label> 
                                <component-input
                                    :input-type="'url'"
                                    :placeholder="'Facebook'"
                                    :name-id="'company[facebook]'"
                                    :value="company.facebook"
                                    :class-input="classCompanyFacebook"
                                    @input="inputCompanyFacebook($event)"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">Twitter</label> 
                                <component-input
                                    :input-type="'url'"
                                    :placeholder="'Twitter'"
                                    :name-id="'company[twitter]'"
                                    :value="company.twitter"
                                    :class-input="classCompanyTwitter"
                                    @input="inputCompanyTwitter($event)"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">Youtube</label> 
                                <component-input
                                    :input-type="'url'"
                                    :placeholder="'Youtube'"
                                    :name-id="'company[youtube]'"
                                    :value="company.youtube"
                                    :class-input="classCompanyYoutube"
                                    @input="inputCompanyYoutube($event)"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">Instagram</label> 
                                <component-input
                                    :input-type="'url'"
                                    :placeholder="'Instagram'"
                                    :name-id="'company[instagram]'"
                                    :value="company.instagram"
                                    :class-input="classCompanyInstagram"
                                    @input="inputCompanyInstagram($event)"
                                /> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-auto pt-2">
                    <div class="col-md-12 py-2">
                        <h5>Informações da API de pagamento</h5>
                        <div class="row mt-2 pb-2">
                            <div class="form-group col-md-6"> 
                                <label for="form19">URL produção*</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'URL de produção'"
                                    :name-id="'payments[url_prod_payment]'"
                                    :value="payments.url_prod_payment"
                                    :class-input="classPaymentsUrlProdPayment"
                                    @input="inputUrlProdPayment($event)"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">URL sandbox*</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'URL de sandbox'"
                                    :name-id="'payments[url_sanbox_payment]'"
                                    :value="payments.url_sanbox_payment"
                                    :class-input="classPaymentsUrlSanboxPayment"
                                    @input="inputUrlSanboxPayment($event)"
                                />
                            </div>

                            <div class="form-group col-md-12"> 
                                <label for="form19">Token*</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Token'"
                                    :name-id="'payments[token_payment]'"
                                    :value="payments.token_payment"
                                    :class-input="classPaymentsTokenPayment"
                                    @input="inputTokenPayment($event)"
                                />
                            </div>
                            <div class="form-group col-md-12"> 
                                <label for="form19">Publico de Token*</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Chave Pública'"
                                    :name-id="'payments[public_key_payment]'"
                                    :value="payments.public_key_payment"
                                    :class-input="classPaymentsPublicKeyPayment"
                                    @input="inputPublicKeyPayment($event)"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 d-flex p-3 ml-auto justify-content-end align-items-center flex-row">
                        <a class="btn btn-outline-primary m-1" href="#" @click="settings">Cancelar</a>
                        <a class="btn btn-primary m-1" href="#" @click="save">Salvar alterações</a>
                    </div>
                </div>
            </form>
        </template>
    </component-card>
</template>
<script>
    import axios from 'axios';

    export default {
        data(){
            return {
                token: '',
                payments: {
                    url_sanbox_payment: '',
                    url_prod_payment: '',
                    token_payment: '',
                    public_key_payment: ''
                },
                company: {
                    name: '',
                    cnpj: '',
                    email: '',
                    facebook: '',
                    twitter: '',
                    youtube: '',
                    instagram: ''
                },
                address: {
                    cep: '',
                    street: '',
                    number: '',
                    complement: '',
                    neighborhood: '',
                    city: '',
                    state: ''
                },
                site: {
                    description: '',
                },
                classPaymentsUrlSanboxPayment: '',
                classPaymentsUrlProdPayment: '',
                classPaymentsTokenPayment: '',
                classPaymentsPublicKeyPayment: '',
                classCompanyName: '',
                classCompanyCnpj: '',
                classCompanyEmail: '',
                classCompanyFacebook: '',
                classCompanyTwitter: '',
                classCompanyYoutube: '',
                classCompanyInstagram: '',
                classAddressCep: '',
                classAddressStreet: '',
                classAddressNumber: '',
                classAddressComplement: '',
                classAddressNeighborhood: '',
                classAddressCity: '',
                classAddressState: '',
                classDescription: '',
                viacep: {},
            }
        },
        methods: {
            settings(){
                axios.get(route('api.admin.settings.index'))
                    .then((response) => {
                        this.payments.url_sanbox_payment = response.data.data.find(setting => setting.name === 'url_sanbox_payment')?.body || '';
                        this.payments.url_prod_payment = response.data.data.find(setting => setting.name === 'url_prod_payment')?.body || '';
                        this.payments.token_payment = response.data.data.find(setting => setting.name === 'token_payment')?.body || '';
                        this.payments.public_key_payment = response.data.data.find(setting => setting.name === 'public_key_payment')?.body || '';
                        this.company.name = response.data.data.find(setting => setting.name === 'name')?.body || '';
                        this.company.cnpj = response.data.data.find(setting => setting.name === 'cnpj')?.body || '';
                        this.company.email = response.data.data.find(setting => setting.name === 'email')?.body || '';
                        this.company.facebook = response.data.data.find(setting => setting.name === 'facebook')?.body || '';
                        this.company.twitter = response.data.data.find(setting => setting.name === 'twitter')?.body || '';
                        this.company.youtube = response.data.data.find(setting => setting.name === 'youtube')?.body || '';
                        this.company.instagram = response.data.data.find(setting => setting.name === 'instagram')?.body || '';
                        this.address.cep = response.data.data.find(setting => setting.name === 'cep')?.body || '';
                        this.address.street = response.data.data.find(setting => setting.name === 'street')?.body || '';
                        this.address.number = response.data.data.find(setting => setting.name === 'number')?.body || '';
                        this.address.complement = response.data.data.find(setting => setting.name === 'complement')?.body || '';
                        this.address.neighborhood = response.data.data.find(setting => setting.name === 'neighborhood')?.body || '';
                        this.address.city = response.data.data.find(setting => setting.name === 'city')?.body || '';
                        this.address.state = response.data.data.find(setting => setting.name === 'state')?.body || '';
                        this.site.description = response.data.data.find(setting => setting.name === 'description')?.body || '';
                    })
            },
            maskCep(string){
                string = string.replace(/\D/g, '');
                if(string.length > 5){
                    string = string.replace(/^(\d{5})(\d{1,3})?$/, '$1-$2');
                }

                return string;
            },
            maskCnpj(string){
                string = string.replace(/\D/g, '');
                string = string
                    .replace(/^(\d{2})(\d)/, '$1.$2')
                    .replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3')
                    .replace(/\.(\d{3})(\d)/, '.$1/$2')
                    .replace(/(\d{4})(\d)/, '$1-$2');

                return string;
            },
            async getAddressByCep (cep) {
                if (cep.length >= 9) {
                    let fixedCep = cep.replace('-', '')
                    await axios.get(route('api.viacep.getAddressByCep', fixedCep))
                        .then(response => this.viacep = response.data)
                        .catch(function(error) {
                            console.log(error.request)
                        })

                    if(Object.keys(this.viacep).length > 0){
                        this.address.street = this.viacep.logradouro;
                        this.address.city = this.viacep.localidade;
                        this.address.neighborhood = this.viacep.bairro;
                        this.address.state = this.viacep.uf;
                    }
                }
            },
            inputPostalCode(event){
                this.address.cep = this.maskCep(event.target.value);
                this.getAddressByCep(this.address.cep);
            },
            inputAddressStreet(event){
                this.address.street = event.target.value;
            },
            inputAddressNumber(event){  
                this.address.number = event.target.value;
            },
            inputAddressComplement(event){
                this.address.complement = event.target.value;
            },
            inputAddressNeighborhood(event){
                this.address.neighborhood = event.target.value;
            },
            inputAddressCity(event){
                this.address.city = event.target.value;
            },
            inputAddressState(event){
                this.address.state = event.target.value;
            },
            textAreaDescription(event){
                this.description = event.target.value;
            },
            inputCompanyName(event){
                this.company.name = event.target.value;
            },
            inputCompanyCnpj(event){
                this.company.cnpj = this.maskCnpj(event.target.value);
            },
            inputCompanyEmail(event){
                this.company.email = event.target.value;
            },
            inputCompanyFacebook(event){
                this.company.facebook = event.target.value;
            },
            inputCompanyTwitter(event){
                this.company.twitter = event.target.value;
            },
            inputCompanyYoutube(event){
                this.company.youtube = event.target.value;
            },
            inputCompanyInstagram(event){
                this.company.instagram = event.target.value;
            },
            inputUrlSanboxPayment(event){
                this.payments.url_sanbox_payment = event.target.value;
            },
            inputUrlProdPayment(event){
                this.payments.url_prod_payment = event.target.value;
            },
            inputTokenPayment(event){
                this.payments.token_payment = event.target.value;
            },
            inputPublicKeyPayment(event){
                this.payments.public_key_payment = event.target.value;
            },
            save(){
                if(this.payments.public_key_payment == '' || this.payments.url_sanbox_payment == '' 
                    || this.payments.url_prod_payment == '' || this.payments.token_payment == ''
                    || this.company.name == '' || this.company.cnpj == '' || this.company.email == ''
                    || this.address.cep == '' || this.address.street == '' || this.address.number == '' 
                    || this.address.neighborhood == '' || this.address.city == '' || this.address.state == ''
                    || this.description == ''
                ){
                    this.classPaymentsPublicKeyPayment = this.payments.public_key_payment == '' ? 'is-invalid' : 'is-valid'
                    this.classPaymentsTokenPayment = this.payments.token_payment == '' ? 'is-invalid' : 'is-valid'
                    this.classPaymentsUrlSanboxPayment = this.payments.url_sanbox_payment == '' ? 'is-invalid' : 'is-valid'
                    this.classPaymentsUrlProdPayment = this.payments.url_prod_payment == '' ? 'is-invalid' : 'is-valid'
                    this.classCompanyName = this.company.name == '' ? 'is-invalid' : 'is-valid'
                    this.classCompanyCnpj = this.company.cnpj == '' ? 'is-invalid' : 'is-valid'
                    this.classCompanyEmail = this.company.email == '' ? 'is-invalid' : 'is-valid'
                    this.classAddressCep = this.address.cep == '' ? 'is-invalid' : 'is-valid'
                    this.classAddressStreet = this.address.street == '' ? 'is-invalid' : 'is-valid'
                    this.classAddressNumber = this.address.number == '' ? 'is-invalid' : 'is-valid'
                    this.classAddressNeighborhood = this.address.neighborhood == '' ? 'is-invalid' : 'is-valid'
                    this.classAddressCity = this.address.city == '' ? 'is-invalid' : 'is-valid'
                    this.classAddressState = this.address.state == '' ? 'is-invalid' : 'is-valid'
                    this.classDescription = this.description == '' ? 'is-invalid' : 'is-valid'

                    return;
                }

                this.classPaymentsPublicKeyPayment = 'is-valid'
                this.classPaymentsTokenPayment = 'is-valid'
                this.classPaymentsUrlSanboxPayment = 'is-valid'
                this.classPaymentsUrlProdPayment = 'is-valid'
                this.classCompanyName = 'is-valid'
                this.classCompanyCnpj = 'is-valid'
                this.classCompanyEmail = 'is-valid'
                this.classCompanyFacebook = 'is-valid'
                this.classCompanyTwitter = 'is-valid'
                this.classCompanyYoutube = 'is-valid'
                this.classCompanyInstagram = 'is-valid'
                this.classAddressCep = 'is-valid'
                this.classAddressStreet = 'is-valid'
                this.classAddressNumber = 'is-valid'
                this.classAddressNeighborhood = 'is-valid'
                this.classAddressCity = 'is-valid'
                this.classAddressState = 'is-valid'
                this.classDescription = 'is-valid'

                this.$refs.form.submit();
            }
        },
        mounted() {
            this.settings();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>