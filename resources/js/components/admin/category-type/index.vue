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
                    <h6>Tipos de Categorias</h6>
                </div>
                <div class="col-lg-1 col-lg-3">
                    <admin-filter-input
                        :name="'Categoria...'"
                        :type="'text'"
                        :icon="'fa fa-search'"
                    ></admin-filter-input>
                </div>
                <div class="col-lg-5 d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createCategory">
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
                            <p class="mb-0 text-sm">
                                {{ category.description }}
                            </p>
                        </component-td>
                        <component-td :class="'align-middle'">
                            <component-dropdown :name="'teste'">
                                <component-dropdown-item name="Editar" target="#editCategory" @click="selectCategory(category)"></component-dropdown-item>
                                <component-dropdown-item name="Excluir" target="#destoryCategory" @click="selectCategory(category)"></component-dropdown-item>
                            </component-dropdown>
                        </component-td>
                    </admin-tr>
                </template>
            </admin-table>
        </template>
    </component-card>

    <model :title="'Editar Categoria'" :name="'editCategory'">
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
                name: '',
                description: '',
                classDescription: '',
                token: '',
                classItem: '',
                classInput: '',
                routeUpdate: '',
                routeDelete: '',
                classInputCheck: 'form-check-input',
                inputCategory: '',
                listSearch: {},
            }
        },
        methods: {
            selectCategory(category){
                this.category = category;
                this.name = category.name;
                this.routeUpdate = route('admin.tipos-de-categorias.update', this.category.id);
                this.routeDelete = route('admin.tipos-de-categorias.destroy', this.category.id);
                this.description = this.category.description;
            },
            listCategories(){
                axios.get(route('api.admin.categorie-types.index'))
                    .then((response) => {
                        this.categories = response.data.data;
                    })
            },
            valueTextArea(event){
                this.description = event.target.value;
            },
            valueInput(event){
                this.name = event.target.value;
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
        },
        mounted() {
            this.listCategories();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>
