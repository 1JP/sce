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
                <div class="col-lg-4">
                    <h6>Classificação Indicativa</h6>
                </div>
                <div class="col-lg-1 col-lg-3">
                    <admin-filter-input
                        :name="'Indicação...'"
                        :type="'text'"
                        :icon="'fa fa-search'"
                        :value-input="inputIndicative"
                        @input="searchInputIndicative($event)"
                    ></admin-filter-input>
                </div>
                <div class="col-lg-5 d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-primary me-2" @click="clear()" v-if="Object.keys(listSearch).length > 0">
                        Limpar filtros
                    </button>
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createIndicativeModal">
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
                    <admin-tr v-for="indicative in indications" :key="indicative.id">
                        <component-td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ indicative.indicative }}</h6>
                                </div>
                            </div>
                        </component-td>
                        <component-td>
                            <p class="mb-0 text-sm">
                                {{ indicative.description }}
                            </p>
                        </component-td>
                        <component-td :class="'align-middle'">
                            <component-dropdown :name="'teste'">
                                <component-dropdown-item name="Editar" target="#editIndicative" @click="selectIndicative(indicative)"></component-dropdown-item>
                                <component-dropdown-item name="Excluir" target="#destoryIndicative" @click="selectIndicative(indicative)"></component-dropdown-item>
                            </component-dropdown>
                        </component-td>
                    </admin-tr>
                </template>
            </admin-table>
        </template>
    </component-card>

    <model :title="'Editar Classificação Indicativa'" :name="'editIndicative'">
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
                            :name-id="'indicative'"
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
                        :value="description"
                        :class-input="classDescription"
                        @input="valueTextArea($event)"
                    />
                </div>
            </div>
        </form>
        <template v-slot:footer>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn bg-gradient-primary" @click="update()">Editar</button>
        </template>
    </model>

    <model :title="'Excluir Classificação Indicativa'" :name="'destoryIndicative'">
        <div class="py-3 text-center">
            <i class="ni ni-bell-55 ni-3x"></i>
            <h4 class="text-gradient text-danger mt-4">Deseja excluir essa indicativa?</h4>
            <p>Todos os posts relacionados a essa indicativa será excluidos também</p>
        </div>
        <form method="POST" :action="routeDelete" ref="formDelete">
            <input type="hidden" name="_token" :value="token"/>
            <input type="hidden" name="_method" value="DELETE" />
        </form>
        <template v-slot:footer>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn bg-gradient-danger" @click="destroy()">Excluir</button>
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
                indications: [],
                indicative: {},
                name: '',
                description: '',
                classDescription: '',
                token: '',
                classItem: '',
                classInput: '',
                routeUpdate: '',
                routeDelete: '',
                classInputCheck: 'form-check-input',
                inputIndicative: '',
                listSearch: {},
            }
        },
        methods: {
            selectIndicative(indicative){
                this.indicative = indicative;
                this.name = indicative.indicative;
                this.routeUpdate = route('admin.classificacao-indicativas.update', this.indicative.id);
                this.routeDelete = route('admin.classificacao-indicativas.destroy', this.indicative.id);
                this.description = this.indicative.description;
            },
            listIndications(){
                axios.get(route('api.admin.indicative-rating.index'))
                    .then((response) => {
                        this.indications = response.data.data;
                    })
            },
            update(){
                if(this.name == '' || this.description == ''){
                    this.classInput = this.name == '' ? 'is-invalid' : 'is-valid'
                    this.classDescription = this.description == '' ? 'is-invalid' : 'is-valid'
                    return;
                }
                
                this.classInput = 'is-valid'
                this.classDescription = 'is-valid'
                this.$refs.formUpdate.submit();
            },
            destroy(){
                this.$refs.formDelete.submit();
            },
            searchInputIndicative(event){
                this.inputIndicative = event.target.value;

                if(this.inputIndicative == ''){
                    this.clear();
                    return;
                }
                
                let params = {
                    'search': {
                        'name' : this.inputIndicative
                    }
                };
                
                this.listSearch = params;

                this.search(params);
            },
            search(params){
                axios.get(route('api.admin.indicative-rating.search'), {params})
                    .then((response) => {
                        this.indications = response.data.data;
                    })
            },
            clear(){
                this.inputIndicative = '',
                this.listSearch = {}
                this.listIndications();
            }
        },
        mounted() {
            this.listIndications();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>