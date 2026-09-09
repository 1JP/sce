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
            category_ids: {
                type: Array,
                default: []
            },
            indicative_rating_ids: {
                type: Array,
                default: []
            }
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
                if (typeof page === 'string') {
                    page = parseInt(page);
                }
                
                this.pagination.links.filter(link => parseInt(link.label) === page).forEach(link => {
                    if(link.url){
                        console.log(link)
                        this.irParaPagina(page, link);
                    }
                });
            },
            listCategories(){
                axios.get(route('api.categories.index'))
                    .then((response) => {
                        this.categories = response.data.data.filter(category => this.category_ids.includes(category.id));
                        this.accordions.filter(accordion => accordion.name === 'Categorias')
                            .forEach(accordion => { 
                                accordion.itens = this.categories.map(category => ({
                                    id: category.id, 
                                    name: category.name,
                                    show: false
                                }));
                            });
                    })
            },
            listIndications(){
                axios.get(route('api.indicative-rating.index'))
                    .then((response) => {
                        this.indications = response.data.data.filter(indication => this.indicative_rating_ids.includes(indication.id));
                        this.accordions.filter(accordion => accordion.name === 'Indicativas')
                            .forEach(accordion => { 
                                accordion.itens = this.indications.map(indication => ({
                                    id: indication.id, 
                                    name: indication.name,
                                    show: false
                                }));
                            });
                    })
            },
            irParaPagina(page, link) {
                const url = new URL(link.url, window.location.origin)
                url.searchParams.set('search[search]', this.search)
                url.searchParams.set('search[order_direction]', this.order)
                url.searchParams.set('search[per_page]', this.display)
                url.searchParams.set('paginate[page]', page)

                window.location.href = url.toString()
            }
        },
        mounted() {
            this.listCategories();
            this.listIndications()
        }
    }
</script>