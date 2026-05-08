<template>
    <div>
        <div class="container px-0">
            <div class="row mx-auto py-2 d-lg-none">
                <div class="col-md-12">
                    <h3 class="">{{ category.name }} <span style="font-weight: normal;" class="text-muted">({{ total }})</span></h3>
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
                            <h3 class="mb-0 mt-0 me-0">{{ category.name }} 
                                <span style="font-weight: normal;" class="text-muted">({{ total }})</span>
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
                        <site-post :posts="allPosts"></site-post>
                    </div>
                    <component-paginate v-if="pagination" :pagination="pagination" @page-change="getPostsByPage"/>
                </div>
            </div>
        </div>
    </div>

    <model :title="'Filtrar por'" :name="'filtros'" :class-header="'bg-primary rounded-0'">
        <div class="row mx-auto" v-if="Object.keys(listSearch).length > 0">
            <div class="col-md-12">
                <a class="btn btn-light rounded m-2" href="#" 
                    v-for="value in listSearch.search.indicative_rating_id" 
                    :key="value"
                    @click="removeList(value, 'indicative_rating')"
                >
                    {{ getNameIndication(value) }}
                    <i class="bi bi-x-circle text-primary ml-2"></i>
                </a>
            </div>
        </div>
        <div class="row mx-auto" v-if="Object.keys(listSearch).length > 0">
            <div class="col-md-12 pt-2 pb-4">
                <button class="btn btn-outline-dark btn-block" @click="clear()">
                    Limpar filtro
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 d-lg-block">
                <component-accordion
                    :key="accordionKey"
                    :itens="accordions"
                    @onChanged="changeAccordion($event)"
                />
            </div>
        </div>
    </model>
</template>

<script>
export default {
    props: {
        category: {
            type: Object,
            required: true
        }
    },
    data(){
        return {
            allPosts:[],
            views: [30, 60, 90, 120],
            filter_by: [
                {id: 2, name: '(A-Z)'},
                {id: 3, name: '(Z-A)'},
            ],
            filter: 2,
            display: 30,
            order: 'asc',
            total: 0,
            pagination: null,
            indications: [],
            accordions: [
                {
                    name: 'Indicativas',
                    itens: []
                }
            ],
            selectedIndications: [],
            listSearch: {},
            accordionKey: 0,
        }
    },
    methods: {
        selectedDisplay(event){
            this.display = event.target.value;
            this.getPostsByPage();
        },
        selectedFilter(event){
            this.filter = event.target.value;
            this.order = this.filter === '2' ? 'asc' : 'desc';
            this.getPostsByPage();
        },
        getAllPosts(page = 1) {
            axios.get(route('api.categories.posts', this.category.id), {params: {per_page: this.display, order_direction: this.order, page: page}})
                .then(response => {
                    this.allPosts = response.data.data;
                    this.total = response.data.meta.total;
                    this.pagination = response.data.meta
                })
                .catch(error => {
                    console.error('Error fetching posts:', error);
                });
        },
        listIndications(){
            axios.get(route('api.indicative-rating.index'))
                .then((response) => {
                    this.indications = response.data.data;
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
        changeAccordion(event){
            if (event.name == 'Indicativas') {
                if (event.checked) {
                    this.selectedIndications.push(event.value);
                } else {
                    const index = this.selectedIndications.indexOf(event.value);
                    if (index > -1) {
                        this.selectedIndications.splice(index, 1);
                    }
                }
            }
            this.search();
        },
        search() {
            let params = {
                'search': {
                    'category_id' : [this.category.id],
                    'indicative_rating_id' : this.selectedIndications,
                    'paginate': {
                        'per_page': this.display,
                        'order_direction': this.order
                    },
                }
            };
            this.listSearch = params;
            axios.get(route('api.site.posts.search', params))
                .then(response => {
                    this.allPosts = response.data.data;
                    this.total = response.data.meta.total;
                    this.pagination = response.data.meta
                })
                .catch(error => {
                    console.error('Error fetching posts:', error);
                });
        },
        getPostsByPage(page = 1){
            if(Object.keys(this.listSearch).length > 0){
                this.search();
                return;
            }
            this.getAllPosts(page);
        },
        clear(){
            this.selectedIndications = [];
            this.listIndications();
            this.listSearch = {};
            this.accordionKey++;
            this.getAllPosts();
        },
        getNameIndication(id){
            const indication = this.indications.find(indication => indication.id === parseInt(id));
            return indication ? indication.name : '';
        },
        removeList(value, type){
            if (type === 'indicative_rating') {
                const indexIndication = this.selectedIndications.indexOf(value);
                if (indexIndication > -1) {
                    this.selectedIndications.splice(indexIndication, 1);
                }
            }

            this.accordions.filter(accordion => accordion.name === 'Indicativas')
                .forEach(accordion => {
                    accordion.itens = this.indications.map(indication => ({
                        id: indication.id, 
                        name: indication.name,
                        show: this.selectedIndications.includes(String(indication.id))
                    }));
                });

            if(this.selectedIndications.length == 0){
                this.clear()
                return;
            }

            this.accordionKey++;
            this.search();
        },
    },
    mounted() {
        this.getAllPosts();
        this.listIndications();
    }
}
</script>

