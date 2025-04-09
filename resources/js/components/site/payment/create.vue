<template>
    <form class="text-left">
        <component-card
            :card-body="true"
            style="background: rgb(237, 235, 228);"
        >
            <template v-slot:body>
                <div class="form-row">
                    <div class="form-group col-lg-12" style="">
                        <label class="text-body-tertiary">Plano *</label>
                        <component-select
                            :is-required="true"
                            :placeholder="'Selecione o plano'"
                            :name-id="'plan_id'"
                            :options="[]"
                            :value-select="plan_id"
                            :class-item="classPlan"
                            @onChanged="valueSelect($event)"
                        />
                    </div>
                </div>
                <h3 class="mb-4 pb-4">Pagamento</h3>
                <div class="row">
                    <div class="form-group col-lg-6"> 
                        <label class="text-body-tertiary">Número do cartão *</label> 
                        <component-input
                            :required="true"
                            :input-type="'text'"
                            :placeholder="'1234 5678 9012 3456'"
                            :name-id="'number_card'"
                            :value="number_card"
                            :class-input="classNumberCard"
                            @input="inputNumberCard($event)"
                        />
                    </div>
                    <div class="form-group col-lg-6"> 
                        <label class="text-body-tertiary">Nome do titular do cartão *</label>
                        <component-input
                            :required="true"
                            :input-type="'text'"
                            :placeholder="'José da Silva'"
                            :name-id="'name'"
                            :value="name"
                            :class-input="className"
                            @input="inputName($event)"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label class="text-body-tertiary">Data de validade *</label>
                        <component-select
                            :is-required="true"
                            :placeholder="'Mês...'"
                            :name-id="'month'"
                            :options="['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']"
                            :value-select="month"
                            :class-item="classMonth"
                            @onChanged="valueSelect($event)"
                        />
                    </div>
                    <div class="form-group col-lg-4">
                        <label class="text-body-tertiary">&nbsp;</label>
                        <component-select
                            :is-required="true"
                            :placeholder="'Ano...'"
                            :name-id="'year'"
                            :options="['2022', '2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030', '2031', '2032', '2033']"
                            :value-select="year"
                            :class-item="classYear"
                            @onChanged="valueSelect($event)"
                        />
                    </div>
                    <div class="form-group col-lg-4"> 
                        <label class="text-body-tertiary">CVV*</label> 
                        <component-input
                            :required="true"
                            :input-type="'text'"
                            :placeholder="'123'"
                            :name-id="'cvv'"
                            :value="cvv"
                            pattern="[0-9]"
                            :max-length="'3'"
                            :class-input="classCvv"
                            @input="inputCvv($event)"
                        /> 
                    </div>
                </div>
                <h3 class="mb-4 pb-4">Endereço</h3>
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
                                :max-length="'9'"
                                :class-input="classPostalCode"
                                @input="inputPostalCode($event)"
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
                            @input="inputStreet($event)"
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
                            @input="inputNumber($event)"
                        />
                    </div>
                    <div class="col-lg-4" style="">
                        <label for="form19" class="text-dark">Complemento</label>
                        <component-input
                            :required="true"
                            :input-type="'text'"
                            :placeholder="'Casa, Apt'"
                            :name-id="'complement'"
                            :value="complement"
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
                            @input="inputLocality($event)"
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
                            @input="inputCity($event)"
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
                            @input="inputRegiaoCode($event)"
                        />
                    </div>
                </div>
                <button type='submit' class="btn btn-primary btn-block rounded w-100" >Criar assinatura</button>
            </template>
        </component-card>
    </form>
</template>
  
<script>
    import axios from 'axios';

    export default {
        props: {
            
        },
        data() {
            return {
                viacep: {},
                token: '',
                classBirthDate: '',
                classCpf: '',
                classPostalCode: '',
                classStreet: '',
                classNumber: '',
                classLocality: '',
                classCity: '',
                classRegionCode: '',
                classPlan: '',
                classNumberCard: '',
                className: '',
                classMonth: '',
                classYear: '',
                classCvv: '',
                birth_date: '',
                plan_id: '',
                cpf: '',
                postal_code: '',
                street: '',
                number: '',
                locality: '',
                city: '',
                region_code: '',
                complement: '',
                number_card: '',
                name: '',
                month: '',
                year: '',
                cvv: '',
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
            valueSelect(event){
                this.plan_id = event.target.value;
            },
            inputNumberCard(event){
                this.number_card = event.target.value;
            },
            inputCvv(event){
                this.cvv = event.target.value;
            }
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>
  