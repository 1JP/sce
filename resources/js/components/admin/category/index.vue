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
                    <h6>Categorias</h6>
                </div>
                <div class="col-lg-1 col-lg-3">
                    <admin-filter-select
                        :name="'Classificação Indicativa'"
                        :options="types"
                    ></admin-filter-select>
                </div>
                <div class="col-lg-1 col-lg-2">
                    <admin-filter-input
                        :name="'Categoria...'"
                        :type="'text'"
                        :icon="'fa fa-search'"
                    ></admin-filter-input>
                </div>
                <div class="col-lg-1 col-lg-2">
                    <admin-filter-select
                        :name="'Status'"
                        :options="['Ativo', 'Desativado']"
                    ></admin-filter-select>
                </div>
                <div class="col-lg-3 d-flex justify-content-end">
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
                            <component-dropdown :name="'teste'">
                                <component-dropdown-item name="Editar" route="#"></component-dropdown-item>
                                <component-dropdown-item name="Excluir" target="#destoryCategory"></component-dropdown-item>
                            </component-dropdown>
                        </component-td>
                    </admin-tr>
                </template>
            </admin-table>
        </template>
    </component-card>
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
            }
        },
        methods: {
            listCategories(){
                axios.get(route('api.admin.categories.index'))
                    .then((response) => {
                        this.categories = response.data.data;
                    })
            }
        },
        mounted() {
            this.listCategories();
        }
    }
</script>
