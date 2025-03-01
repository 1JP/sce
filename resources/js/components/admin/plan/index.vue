<template>

    <component-card
        :class-card="'mb-4'"
        :card-header="true"
        :class-header="'pb-0'"
        :card-body="true"
        :class-body="'px-0 pt-0 pb-2'"
    >
        <template v-slot:header>
            <div class="row">
                <div class="col-lg-2">
                    <h6>Planos</h6>
                </div>
                <div class="col-lg-2 col-lg-3">
                    <div class="form-group">
                        <admin-filter-select
                            :name="'Status'"
                            :options="['Ativo', 'Desativado']"
                            :value-select="selectedStatus"
                        ></admin-filter-select>
                    </div>
                </div>
                <div class="col-lg-2 col-lg-3">
                    <admin-filter-input
                        :name="'Plano...'"
                        :type="'text'"
                        :icon="'fa fa-search'"
                    ></admin-filter-input>
                </div>
                <div class="col-lg-4 d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-primary me-2" @click="clear()" v-if="Object.keys(listSearch).length > 0">
                        Limpar filtros
                    </button>
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createPlanModal">
                        Cadastrar
                    </button>
                </div>
            </div>
        </template>
        <template v-slot:body>
            <admin-table>
                <template v-slot:thead>
                    <admin-thead
                        v-for="tha, index in ths"
                        :key="index"
                        :class="tha.class"
                    >
                        {{ tha.name }}
                    </admin-thead>
                </template>
                <template v-slot:tbody>
                    <admin-tr v-for="plan in plans" :key="plan.id">
                        <component-td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">
                                        {{ plan.name }}
                                    </h6>
                                </div>
                            </div>
                        </component-td>
                        <component-td>
                            <h6 class="mb-0 text-sm">
                                {{ plan.description }}
                            </h6>
                        </component-td>
                        <component-td :class="'align-middle text-sm'">
                            <component-span-status :class="'bg-gradient-success'" v-if="plan.active">Ativo</component-span-status>
                            <component-span-status :class="'bg-gradient-danger'" v-else>Desativado</component-span-status>
                        </component-td>
                        <component-td :class="'align-middle text-center'">
                            <h6 class="mb-0 text-sm">{{ plan.number_film }}</h6>
                        </component-td>
                        <component-td :class="'align-middle text-center'">
                            <h6 class="mb-0 text-sm">{{ plan.number_book }}</h6>
                        </component-td>
                        <component-td :class="'align-middle text-center'">
                            <h6 class="mb-0 text-sm">{{ plan.number_serie }}</h6>
                        </component-td>
                        <component-td :class="'align-middle text-center'">
                            <h6 class="mb-0 text-sm">{{ plan.count_assinatura }}</h6>
                        </component-td>
                        <component-td>
                            <component-dropdown :name="'planDropdown'">
                                <component-dropdown-item name="Visualizar" target="#viewPlanoModal" @click="selectPlan(plan)"></component-dropdown-item>
                                <component-dropdown-item name="Editar" target="#editPlanoModal" @click="selectPlan(plan)"></component-dropdown-item>
                                <component-dropdown-item name="Excluir" target="#destoryPlan"></component-dropdown-item>
                            </component-dropdown>
                        </component-td>
                    </admin-tr>
                </template>
            </admin-table>
        </template>
    </component-card>

    <model :title="'Editar Plano'" :name="'editPlanoModal'">
        <form method="POST" :action="routeUpdate" ref="formUpdate">
            <input type="hidden" name="_token" :value="token"/>
            <input type="hidden" name="_method" value="PATCH" />
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
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="active" value="1" id="flexSwitchCheckDefault" v-if="plan.active" checked="">
                            <input class="form-check-input" type="checkbox" name="active" value="0" id="flexSwitchCheckDefault" v-else>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Ativo</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <template v-slot:footer>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn bg-gradient-primary" @click="update()">Editar</button>
        </template>
    </model>

    <model :title="plan.name" :name="'viewPlanoModal'">
        <div class="row">
            <div class="col-lg-12 col-lg-3">
                <div class="form-group"> 
                    <h5>Descrição:</h5> 
                    <p class="text-center">
                        {{ plan.description }}
                    </p> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-3">
                <div class="form-group"> 
                    <h5>Filmes:</h5> 
                    <p>{{ plan.number_film }}</p> 
                </div>
            </div>
            <div class="col-lg-4 col-lg-3">
                <div class="form-group"> 
                    <h5>Series:</h5> 
                    <p>{{ plan.number_serie }}</p> 
                </div>
            </div>
            <div class="col-lg-4 col-lg-3">
                <div class="form-group"> 
                    <h5>Livros:</h5> 
                    <p>{{ plan.number_book }}</p> 
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-3">
                <div class="form-group"> 
                    <h5>Ativo:</h5> 
                    <p v-if="plan.active">Sim</p> 
                    <p v-else>Não</p> 
                </div>
            </div>
            <div class="col-lg-4 col-lg-3">
                <div class="form-group"> 
                    <h5>Assinatura:</h5> 
                    <p>{{ plan.count_assinatura }}</p> 
                </div>
            </div>
            <div class="col-lg-4 col-lg-3">
                <div class="form-group"> 
                    <h5>Valor:</h5> 
                    <p>R$ {{ plan.value }}</p> 
                </div>
            </div>
        </div>
        <template v-slot:footer>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        </template>
    </model>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            ths: {
                type: Array,
                default: () => []
            },
        },
        data(){
            return {
                plans: [],
                plan: {},
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
                activePlan: '',
                token: '',
                routeUpdate: '',
                routeDelete: '',
                selectedStatus: '',
                listSearch: {},
            }
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
            listPlans(){
                axios.get(route('api.admin.plans.index'))
                    .then((response) => {
                        this.plans = response.data.data;
                    })
            },
            selectPlan(plan){
                this.plan = plan;
                this.routeUpdate = route('admin.planos.update', this.plan.id);
                this.routeDelete = route('admin.planos.destroy', this.plan.id);
                this.name = plan.name;
                this.description = plan.description;
                this.numberFilm = plan.number_film;
                this.numberSerie = plan.number_serie;
                this.numberBook = plan.number_book;
                this.valuePlan = plan.value;
                this.activePlan = plan.active;
            },
            update(){
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
                this.$refs.formUpdate.submit();
            }
        },
        mounted() {
            this.listPlans();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>