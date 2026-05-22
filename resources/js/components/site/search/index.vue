<template>
    <div>
        <div class="container px-0">
            <div class="row mx-auto py-2 d-lg-none">
                <div class="col-md-12">
                    <h3 class="">
                        {{ search }}
                        <span style="font-weight: normal;" class="text-muted">
                            ({{ total }})
                        </span>
                    </h3>
                </div>
            </div>
            <div class="row mx-auto align-items-center">
                <div class="col-6 d-lg-none">
                    <div class="form-group mb-0">
                        <component-select
                            :options='filter_by'
                            :name-id="'filter_by'"
                            :value-select="filter"
                            @onChanged="selectedFilter($event)"
                        />
                    </div>
                </div>
                <!-- Botão Filtros -->
                <div class="col-6 d-lg-none">
                    <button type="button" class="btn btn-primary rounded d-flex align-items-center justify-content-center w-100" 
                    style="height: 40px;margin-bottom: 38px; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#filtros">
                        <i class="bi bi-sliders" style="margin-right: 5px;"></i> Filtros
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="py-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-none d-lg-block">
                    <component-accordion
                        :key="accordionKey"
                        :itens="accordions"
                        @onChanged="changeAccordion($event)"
                    />
                </div>
                <div class="col-lg-9">
                    <div class="row d-none d-lg-block">
                        <div class="col-lg-12 d-flex justify-content-between align-items-start">
                            <h3 class="mb-0 mt-0 me-0">
                                {{ search }} 
                                <span style="font-weight: normal;" class="text-muted">
                                    ({{ total }})
                                </span>
                            </h3>
                            <div class="row">
                                <label class="col-form-label col-lg-4">Exibir</label>
                                <div class="col-lg-8">
                                    <component-select
                                        :options='views'
                                        :name-id="'display'"
                                        :value-select="display"
                                        @onChanged="selectedDisplay($event)"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-form-label col-lg-6">Filtrar por:</label>
                                <div class="col-lg-6">
                                    <component-select
                                        :options='filter_by'
                                        :name-id="'filter_by'"
                                        :value-select="filter"
                                        @onChanged="selectedFilter($event)"
                                    />
                                </div>
                            </div>
                        </div>
                        <button v-if="Object.keys(listSearch).length > 0" class="btn btn-outline-dark btn-block" @click="clear()">
                            Limpar filtro
                        </button>
                    </div>
                    <div class="row mb-4">
                        <site-post :posts="posts"></site-post>
                    </div>
                    <component-paginate v-if="pagination" :pagination="pagination" @page-change="getPostsByPage"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            search: {
                type: String,
                default: ''
            },
            total: {
                type: Number,
                default: 0
            },
            posts: {
                type: Array,
                default: []
            },
            pagination: {
                type: Object,
                default: null
            },
        },
        data(){
            return {
                views: [30, 60, 90, 120],
                filter_by: [
                    {id: 2, name: '(A-Z)'},
                    {id: 3, name: '(Z-A)'},
                ],
                filter: 2,
                display: 30,
                order: 'asc',
                accordions: [
                    {
                        name: 'Categorias',
                        itens: []
                    },
                    {
                        name: 'Indicativas',
                        itens: []
                    }
                ],
                accordionKey: 0,
                selectedCategories: [],
                selectedIndications: [],
                listSearch: {},
                categories: [],
                indications: [],
            }
        },
        methods: {
            clear(){
                //
            },
            getPostsByPage(page = 1){
                if(Object.keys(this.listSearch).length > 0){
                    this.search();
                    return;
                }
                this.getAllPosts(page);
            },
            getAllPosts(page = 1) {
                //
            },
        },
        mounted() {
            //
        }
    }
</script>