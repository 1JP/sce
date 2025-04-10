<template>
    <form class="text-left" :action="routeForm" method="POST" ref="formPayment">
        <input type="hidden" name="_token" :value="token"/>
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
                            :options="plans"
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
                            :max-length="'19'"
                            :class-input="classNumberCard"
                            @input="inputNumberCard($event)"
                        />
                    </div>
                    <div class="form-group col-lg-6"> 
                        <label class="text-body-tertiary">Nome do titular do cartão *</label>
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
                            @onChanged="valueSelectMonth($event)"
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
                            @onChanged="valueSelectYear($event)"
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
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label class="text-body-tertiary">CPF *</label>
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
                    <div class="form-group col-lg-4">
                        <label class="text-body-tertiary">Data de Nascimento*</label>
                        <component-input
                            :required="true"
                            :input-type="'date'"
                            :name-id="'birth_date'"
                            :value="birth_date"
                            :class-input="classBirthDate"
                            @input="inputBirthDate($event)"
                        />
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="form19"  class="text-body-tertiary">Telefone *</label>
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
                <h3 class="mb-4 pb-4">Endereço</h3>
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
                <button type='button' @click="save()" class="btn btn-primary btn-block rounded w-100" >Criar assinatura</button>
            </template>
        </component-card>
    </form>
</template>
  
<script>
    import axios from 'axios';
    import { usePaymentStore } from '../../../stores/paymentStore';

    export default {
        props: {
            
        },
        data() {
            return {
                routeForm: route('pagamento.store'),
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
                phone: '',
                city: '',
                region_code: '',
                complement: '',
                number_card: '',
                name: '',
                month: '',
                year: '',
                cvv: '',
                plans: [],
            };
        },
        methods: {
            listPlans(){
                axios.get(route('api.admin.plans.index'))
                    .then((response) => {
                        this.plans = response.data.data;
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
            maskCard(string){
                let value = string.replace(/\D/g, '');
                value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
                string = value.trim();

                return string;
            },
            valueSelectMonth(){
                this.month = event.target.value;
            },
            valueSelectYear(){
                this.year = event.target.value;
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
                let selectedPlan = this.plans.find(plan => String(plan.id) === String(this.plan_id));
                this.createPayment(selectedPlan);
            },
            inputPhone(event){
                if(/^[a-zA-Z]$/.test(event.target.value)){
                    this.phone = null;
                    return;
                }
                this.phone = this.maskPhoneNumber(event.target.value);
            },
            inputNumberCard(event){
                this.number_card = this.maskCard(event.target.value);
            },
            inputCvv(event){
                this.cvv = event.target.value;
            },
            createPayment(plan){
                const paymentStore = usePaymentStore();

                paymentStore.setPayment({
                    id: plan.id,
                    name: plan.name,
                    value: plan.value,
                    description: plan.description,
                    number_book: plan.number_book,
                    number_film: plan.number_film,
                    number_serie: plan.number_serie,
                })
            },
            checkEmptyFields() {
                if(this.name == '' || this.number_card == '' || this.plan_id == '' ||
                 this.cpf == '' || this.month == '' || this.year == '' || this.cvv == '' ||
                 this.postal_code == '' || this.street == '' || this.number == '' ||
                 this.locality == '' || this.city == '' || this.region_code == '' || this.birth_date == ''){
                    this.className = this.name == '' ? 'is-invalid' : 'is-valid'
                    this.classBirthDate = this.birth_date == '' ? 'is-invalid' : 'is-valid'
                    this.classNumberCard = this.number_card == '' ? 'is-invalid' : 'is-valid'
                    this.classCpf = this.cpf == '' ? 'is-invalid' : 'is-valid'
                    this.classMonth = this.month == '' ? 'is-invalid' : 'is-valid'
                    this.classYear = this.year == '' ? 'is-invalid' : 'is-valid'
                    this.classPostalCode = this.postal_code == '' ? 'is-invalid' : 'is-valid'
                    this.classStreet = this.street == '' ? 'is-invalid' : 'is-valid'
                    this.classNumber = this.number == '' ? 'is-invalid' : 'is-valid'
                    this.classLocality = this.locality == '' ? 'is-invalid' : 'is-valid'
                    this.classCity = this.city == '' ? 'is-invalid' : 'is-valid'
                    this.classRegionCode = this.region_code == '' ? 'is-invalid' : 'is-valid'
                    this.classPlan = this.plan_id == '' ? 'is-invalid' : 'is-valid';
                    this.classCvv = this.cvv == '' ? 'is-invalid' : 'is-valid';
                    this.classPhone = this.phone == '' ? 'is-invalid' : 'is-valid';
                    return true;
                }

                this.className = 'is-valid'
                this.classNumberCard = 'is-valid'
                this.classPhone = 'is-valid'
                this.classCpf = 'is-valid'
                this.classMonth = 'is-valid'
                this.classYear = 'is-valid'
                this.classPostalCode = 'is-valid'
                this.classStreet = 'is-valid'
                this.classLocality = 'is-valid'
                this.classCity = 'is-valid'
                this.classRegionCode = 'is-valid'
                this.classNumber = 'is-valid'
                this.classPlan = 'is-valid';
                this.classCvv = 'is-valid';
                this.classBirthDate = 'is-valid'

                return false;
            },
            save(){
                if(this.checkEmptyFields()) return;
                this.$refs.formPayment.submit();
            }
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
            this.listPlans();
        }
    }
</script>
  