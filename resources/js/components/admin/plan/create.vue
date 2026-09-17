<template>

    <model :title="title" :name="nameId">
        <form method="POST" :action="routeCreate" ref="form">
            <input type="hidden" name="_token" :value="token"/>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <component-input
                            :required="true"
                            :input-type="'name'"
                            :placeholder="'Nome'"
                            :name-id="'name'"
                            :value="name"
                            :class-input="classInput"
                            @input="valueInput($event)"
                        />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <component-text-area
                        :is-required="true"
                        :placeholder="'Descrição'"
                        :name-id="'description'"
                        :class-input="classDescription"
                        :value="description"
                        @input="valueTextArea($event)"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <component-input
                            :required="true"
                            :input-type="'number'"
                            :placeholder="'Filme'"
                            :name-id="'number_film'"
                            :value="numberFilm"
                            :class-input="classFilm"
                            @input="valueInputFilm($event)"
                        />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <component-input
                            :required="true"
                            :input-type="'number'"
                            :placeholder="'Serie'"
                            :name-id="'number_serie'"
                            :value="numberSerie"
                            :class-input="classSerie"
                            @input="valueInputSerie($event)"
                        />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <component-input
                            :required="true"
                            :input-type="'number'"
                            :placeholder="'Livro'"
                            :name-id="'number_book'"
                            :value="numberBook"
                            :class-input="classBook"
                            @input="valueInputBook($event)"
                        />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <component-input
                        :required="true"
                        :input-type="'text'"
                        :placeholder="'Valor'"
                        :name-id="'value'"
                        :value="valuePlan"
                        :class-input="classValuePlan"
                        @input="valueInputPlan($event)"
                    />
                </div>
            </div>
        </form>
        <template v-slot:footer>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn bg-gradient-primary" @click="save()">Salvar</button>
        </template>
    </model>
</template>

<script>
    export default {
        data(){
            return {
                classInput: '',
                classDescription: '',
                classSerie: '',
                classFilm: '',
                classBook: '',
                classValuePlan: '',
                name: '',
                description: '',
                numberFilm: '',
                numberSerie: '',
                numberBook: '',
                valuePlan: '',
                token: '',
                routeCreate: route('admin.planos.store')
            }
        },
        props: {
            title: {
                type: String,
                required: true,
            }, 
            nameId: {
                type: String,
                required: true,
            },
        },
        methods: {
            maskMount(string){
                string = string.replace(/\D/g, '');
                string = (string / 100).toFixed(2) + '';
                string = string.replace('.', ',');
                string = string.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                return string;
            },
            valueTextArea(event){
                this.description = event.target.value;
            },
            valueInput(event){
                this.name = event.target.value;
            },
            valueInputFilm(event){
                this.numberFilm = event.target.value;
            },
            valueInputSerie(event){
                this.numberSerie = event.target.value;
            },
            valueInputBook(event){
                this.numberBook = event.target.value;
            },
            valueInputPlan(event){
                if(/^[a-zA-Z]$/.test(event.target.value)){
                    this.valuePlan = null;
                    event.target.value = null
                    return;
                }
                this.valuePlan = this.maskMount(event.target.value);
            },
            save(){
                if(this.name == '' || this.description == '' 
                    || this.numberFilm == '' || this.numberSerie == ''
                    || this.numberBook == '' || this.valuePlan == ''
                ){
                    this.classInput = this.name == '' ? 'is-invalid' : 'is-valid'
                    this.classDescription = this.description == '' ? 'is-invalid' : 'is-valid'
                    this.classFilm = this.numberFilm == '' ? 'is-invalid' : 'is-valid'
                    this.classSerie = this.numberSerie == '' ? 'is-invalid' : 'is-valid'
                    this.classBook = this.numberBook == '' ? 'is-invalid' : 'is-valid'
                    this.classValuePlan = this.valuePlan == '' ? 'is-invalid' : 'is-valid'

                    return;
                }

                this.classInput = 'is-valid'
                this.classDescription = 'is-valid'
                this.classFilm = 'is-valid'
                this.classSerie = 'is-valid'
                this.classBook = 'is-valid'
                this.classValuePlan = 'is-valid'
                this.$refs.form.submit();
            },
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>
