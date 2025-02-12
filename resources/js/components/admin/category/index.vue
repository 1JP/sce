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
                <div class="col-lg-1">
                    <h6>Categorias</h6>
                </div>
                <div class="col-lg-1 col-lg-2">
                    <admin-filter-select
                        :name="'Classificação Indicativa'"
                        :options="types"
                        :value-select="selectedIndicative"
                        @onChanged="filterSelect($event)"
                    ></admin-filter-select>
                </div>
                <div class="col-lg-1 col-lg-2">
                    <admin-filter-input
                        :name="'Categoria...'"
                        :type="'text'"
                        :icon="'fa fa-search'"
                        :value-input="inputCategory"
                        @input="searchInputCategory($event)"
                    ></admin-filter-input>
                </div>
                <div class="col-lg-1 col-lg-2">
                    <admin-filter-select
                        :name="'Status'"
                        :options="['Ativo', 'Desativado']"
                        :value-select="selectedStatus"
                        @onChanged="filterSelectStatus($event)"
                    ></admin-filter-select>
                </div>
                <div class="col-lg-5 d-flex justify-content-end align-items-center">
                    <button type="button" class="btn bg-gradient-primary me-2" @click="clear()" v-if="Object.keys(listSearch).length > 0">
                        Limpar filtros
                    </button>
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
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
                    <admin-tr v-for="category in categories" :key="category.id">
                        <component-td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ category.name }}</h6>
                                </div>
                            </div>
                        </component-td>
                        <component-td>
                            <h6 class="mb-0 text-sm">
                                {{ category.types }}
                            </h6>
                        </component-td>
                        <component-td :class="'align-middle text-center text-sm'">
                            <span class="text-secondary text-xs font-weight-bold">{{ category.posts }}</span>
                        </component-td>
                        <component-td :class="'align-middle text-center'">
                            <component-span-status :class="'bg-gradient-success'" v-if="category.active">Ativo</component-span-status>
                            <component-span-status :class="'bg-gradient-danger'" v-else>Desativado</component-span-status>
                        </component-td>
                        <component-td>
                            <component-dropdown :name="'category'">
                                <component-dropdown-item name="Editar" target="#updateCategoryModal" @click="selectCategory(category)"></component-dropdown-item>
                                <component-dropdown-item name="Excluir" target="#destoryCategory" @click="selectCategory(category)"></component-dropdown-item>
                            </component-dropdown>
                        </component-td>
                    </admin-tr>
                </template>
            </admin-table>
        </template>
    </component-card>

    <model :title="'Editar Categoria'" :name="'updateCategoryModal'">
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
                    <component-select
                        :is-required="true"
                        :placeholder="'Classificação Indicativas'"
                        :name-id="'category_type_id[]'"
                        :is-mutiple="true"
                        :options='types'
                        :class-item="classItem"
                        :value-select="categoryTypeIds"
                        @onChanged="valueSelect($event)"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="active" v-if="category.active" value="true" checked="">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="active" v-else>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Ativo</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <template v-slot:footer>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn bg-gradient-primary" @click="update()">Editar</button>
        </template>
    </model>

    <model :title="'Excluir Categoria'" :name="'destoryCategory'">
        <div class="py-3 text-center">
            <i class="ni ni-bell-55 ni-3x"></i>
            <h4 class="text-gradient text-danger mt-4">Deseja excluir essa categoria?</h4>
            <p>Todos os posts relacionados a essa Categoria será excluidos também</p>
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
            types: {
                type: Array,
                default: () => []
            }
        },
        data(){
            return {
                categories: [],
                category: {},
                categoryTypeIds: [],
                name: '',
                token: '',
                classItem: '',
                classInput: '',
                routeUpdate: '',
                routeDelete: '',
                classInputCheck: 'form-check-input',
                selectedIndicative: '',
                selectedStatus: '',
                inputCategory: '',
                listSearch: {},
            }
        },
        methods: {
            selectCategory(category){
                this.category = category;
                this.name = category.name;
                this.routeUpdate = route('admin.categorias.update', this.category.id);
                this.routeDelete = route('admin.categorias.destroy', this.category.id);
                this.categoryTypeIds = this.category.category_types.map(ct => ct.id);
            },
            listCategories(){
                axios.get(route('api.admin.categories.index'))
                    .then((response) => {
                        this.categories = response.data.data;
                    })
            },
            valueSelect(event){
                this.categoryTypeIds = event.target.value;
            },
            valueInput(event){
                this.name = event.target.value;
            },
            update(){
                if(this.name == '' || this.categoryTypeIds == ''){
                    this.classInput = this.name == '' ? 'is-invalid' : 'is-valid'
                    this.classItem = this.categoryTypeIds == '' ? 'is-invalid' : 'is-valid'
                    return;
                }
                
                this.classInput = 'is-valid';
                this.classItem = 'is-valid';

                this.$refs.formUpdate.submit();
            },
            destroy(){
                this.$refs.formDelete.submit();
            },
            filterSelect(event){
                this.selectedIndicative = event.target.value;
                let params = {
                    'search': {
                        'category_type_id' : this.selectedIndicative
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.category_type_id = this.selectedIndicative
                }
                
                this.listSearch = params;
                this.search(params);
            },
            filterSelectStatus(event){
                this.selectedStatus = event.target.value;
                let status = 0;

                if (this.selectedStatus == 'Ativo') {
                    status = 1
                } else {
                    status = 0
                }

                let params = {
                    'search': {
                        'status' : status
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.status = status
                }
                
                this.listSearch = params;
                this.search(params);
            },
            searchInputCategory(event){
                this.inputCategory = event.target.value;
                let params = {
                    'search': {
                        'name' : this.inputCategory
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.name = this.inputCategory
                }
                
                this.listSearch = params;
                this.search(params);
            },
            search(params){
                axios.get(route('api.admin.categories.search'), {params})
                    .then((response) => {
                        this.categories = response.data.data;
                    })
            },
            clear(){
                this.inputCategory = '',
                this.selectedStatus = '',
                this.selectedIndicative = '',
                this.listSearch = {}
                this.listCategories();
            }
        },
        mounted() {
            this.listCategories();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>
