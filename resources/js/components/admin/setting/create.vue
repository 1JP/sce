<template>
    <component-card
        :card-body="true"
    >
        <template v-slot:body>
            <form class="" method="POST" ref="form" >
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
                                    :name-id="'cep_company'"
                                    :value="address.cep"
                                    :class-input="classAddressCep"
                                    @input="valueInput($event)"
                                />
                            </div>
                            <div class="form-group col-md-8"> 
                                <label for="form19">Endereço*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Endereço'"
                                    :name-id="'address_company'"
                                    :value="address.address"
                                    :class-input="classAddressStreet"
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
                                    :name-id="'number_company'"
                                    :value="address.number"
                                    :class-input="classAddressNumber"
                                />  
                            </div>
                            <div class="form-group col-md-4"> 
                                <label for="form19">Complemento*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Complemento'"
                                    :name-id="'complement_company'"
                                    :value="address.complement"
                                    :class-input="classAddressComplement"
                                />  
                            </div>
                            <div class="form-group col-md-4"> 
                                <label for="form19">Bairro*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Bairro'"
                                    :name-id="'neighborhood_company'"
                                    :value="address.neighborhood"
                                    :class-input="classAddressNeighborhood"
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
                                    :name-id="'city_company'"
                                    :value="address.city"
                                    :class-input="classAddressCity"
                                />
                            </div>
                            <div class="form-group col-md-4"> 
                                <label for="form19">Estado*</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Estado'"
                                    :name-id="'state_company'"
                                    :value="address.state"
                                    :class-input="classAddressState"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-md-12 border-bottom">
                        <h5>Informações gerais do site</h5>
                        <div class="row mt-2">
                            <div class="form-group col-md-12"> <label for="form19">Descrição</label>
                                <div class="form-group">
                                    <component-text-area
                                        :is-required="true"
                                        :placeholder="'Descrição'"
                                        :name-id="'description'"
                                        :value="description"
                                        :class-input="classDescription"
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
                                    :name-id="'name_company'"
                                    :value="company.name"
                                    :class-input="classCompanyName"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">CNPJ*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'CNPJ'"
                                    :name-id="'cnpj_company'"
                                    :value="company.cnpj"
                                    :class-input="classCompanyCnpj"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">E-mail*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'email'"
                                    :placeholder="'E-mail'"
                                    :name-id="'email_company'"
                                    :value="company.email"
                                    :class-input="classCompanyEmail"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">Facebook*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Facebook'"
                                    :name-id="'facebook_company'"
                                    :value="company.facebook"
                                    :class-input="classCompanyFacebook"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">Twitter*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Twitter'"
                                    :name-id="'twitter_company'"
                                    :value="company.twitter"
                                    :class-input="classCompanyTwitter"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">Youtube*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Youtube'"
                                    :name-id="'youtube_company'"
                                    :value="company.youtube"
                                    :class-input="classCompanyYoutube"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">Instagram*</label> 
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Instagram'"
                                    :name-id="'instagram_company'"
                                    :value="company.instagram"
                                    :class-input="classCompanyInstagram"
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
                                    :name-id="'url_prod_payment'"
                                    :value="payments.url_prod_payment"
                                    :class-input="classPaymentsUrlProdPayment"
                                />
                            </div>
                            <div class="form-group col-md-6"> 
                                <label for="form19">URL sandbox*</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'URL de sandbox'"
                                    :name-id="'url_sanbox_payment'"
                                    :value="payments.url_sanbox_payment"
                                    :class-input="classPaymentsUrlSanboxPayment"
                                />
                            </div>

                            <div class="form-group col-md-12"> 
                                <label for="form19">Token*</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Token'"
                                    :name-id="'token_payment'"
                                    :value="payments.token_payment"
                                    :class-input="classPaymentsTokenPayment"
                                />
                            </div>
                            <div class="form-group col-md-12"> 
                                <label for="form19">Publico de Token*</label>
                                <component-input
                                    :required="true"
                                    :input-type="'text'"
                                    :placeholder="'Chave Pública'"
                                    :name-id="'public_key_payment'"
                                    :value="payments.public_key_payment"
                                    :class-input="classPaymentsPublicKeyPayment"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 d-flex p-3 ml-auto justify-content-end align-items-center flex-row">
                        <a class="btn btn-outline-primary m-1" href="#">Cancelar</a>
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
                description: '',
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

                    })
            },
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
            save(){
                if(this.payments.public_key_payment == '' || this.payments.url_sanbox_payment == '' 
                    || this.payments.url_prod_payment == '' || this.payments.token_payment == ''
                    || this.company.name == '' || this.company.cnpj == '' || this.company.email == '' || this.company.facebook == ''
                    || this.company.twitter == '' || this.company.youtube == '' || this.company.instagram == ''
                    || this.address.cep == '' || this.address.street == '' || this.address.number == '' || this.address.complement == '' 
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
                    this.classCompanyFacebook = this.company.facebook == '' ? 'is-invalid' : 'is-valid'
                    this.classCompanyTwitter = this.company.twitter == '' ? 'is-invalid' : 'is-valid'
                    this.classCompanyYoutube = this.company.youtube == '' ? 'is-invalid' : 'is-valid'
                    this.classCompanyInstagram = this.company.instagram == '' ? 'is-invalid' : 'is-valid'
                    this.classAddressCep = this.address.cep == '' ? 'is-invalid' : 'is-valid'
                    this.classAddressStreet = this.address.street == '' ? 'is-invalid' : 'is-valid'
                    this.classAddressNumber = this.address.number == '' ? 'is-invalid' : 'is-valid'
                    this.classAddressComplement = this.address.complement == '' ? 'is-invalid' : 'is-valid'
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
                this.classAddressComplement = 'is-valid'
                this.classAddressNeighborhood = 'is-valid'
                this.classAddressCity = 'is-valid'
                this.classAddressState = 'is-valid'
                this.classDescription = 'is-valid'

                console.log('Salvar alterações')
            }
        },
        mounted() {
            this.settings();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>