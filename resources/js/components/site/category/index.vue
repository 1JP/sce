<template>
    <div>
        <div class="container px-0">
            <div class="row mx-auto py-2 d-lg-none">
                <div class="col-md-12">
                    <h3 class="">Categorias <span style="font-weight: normal;" class="text-muted">({{ total }})</span></h3>
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
                    <component-accordion/>
                </div>
                <div class="col-lg-9">
                    <div class="row d-none d-lg-block">
                        <div class="col-lg-12 d-flex justify-content-between align-items-start">
                            <h3 class="mb-0 mt-0 me-0">Categorias 
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
                    </div>
                    <div class="row mb-4">
                        <site-post :posts="allPosts"></site-post>
                    </div>
                    <component-paginate v-if="pagination" :pagination="pagination" @page-change="getAllPosts()"/>
                </div>
            </div>
        </div>
    </div>

    <model :title="'Filtrar por'" :name="'filtros'" :class-header="'bg-primary rounded-0'">
        <div class="row mx-auto">
            <div class="col-md-12">
                <a class="btn btn-light rounded m-2" href="#">Nome A
                    <i class="bi bi-x-circle text-primary ml-2"></i>
                </a>
                <a class="btn btn-light rounded m-2" href="#">
                    Nome B
                    <i class="bi bi-x-circle text-primary ml-2"></i>
                </a>
            </div>
        </div>
        <div class="row mx-auto">
            <div class="col-md-12 pt-2 pb-4">
                <a class="btn btn-outline-dark btn-block" href="#">Limpar filtro</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 d-lg-block">
                <component-accordion/>
            </div>
        </div>
    </model>
</template>

<script>
export default {
    props: {
        //
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
        }
    },
    methods: {
        selectedDisplay(event){
            this.display = event.target.value;
            this.getAllPosts();
        },
        selectedFilter(event){
            this.filter = event.target.value;
            this.order = this.filter === '2' ? 'asc' : 'desc';
            this.getAllPosts();
        },
        getAllPosts(page = 1) {
            axios.get(route('api.posts.all', {per_page: this.display, order_direction: this.order, page: page}))
                .then(response => {
                    this.allPosts = response.data.data;
                    this.total = response.data.meta.total;
                    this.pagination = response.data.meta
                })
                .catch(error => {
                    console.error('Error fetching posts:', error);
                });
        },
    },
    mounted() {
        this.getAllPosts();
    }
}
</script>

