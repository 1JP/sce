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
                    <h6>Posts</h6>
                </div>
                <div class="col-lg-1 col-lg-2">
                    <admin-filter-select
                        :name="'Classificação Indicativa'"
                        :options="indications"
                        :value-select="selectedIndicativeRating"
                        @onChanged="filterIndicativeRating($event)"
                    ></admin-filter-select>
                </div>
                <div class="col-lg-1 col-lg-2">
                    <admin-filter-input
                        :name="'Post...'"
                        :type="'text'"
                        :icon="'fa fa-search'"
                        :value-input="inputPost"
                        @input="searchInputPost($event)"
                    ></admin-filter-input>
                </div>
                <div class="col-lg-1 col-lg-2">
                    <admin-filter-select
                        :name="'Categoria'"
                        :options="categories"
                        :value-select="selectedCategory"
                        @onChanged="filterCategory($event)"
                    ></admin-filter-select>
                </div>
                <div class="col-lg-1 col-lg-2">
                    <admin-filter-select
                        :name="'Status'"
                        :options="['Ativo', 'Desativado']"
                        :value-select="selectedStatus"
                        @onChanged="filterSelectStatus($event)"
                    ></admin-filter-select>
                </div>
                <div class="col-lg-1 col-lg-2" v-if="Object.keys(listSearch).length > 0">
                    <button type="button" class="btn bg-gradient-primary" @click="clear()">
                        Limpar filtros
                    </button>
                </div>
                <div class="col-lg-1 col-lg-1" v-if="created">
                    <a :href="route('admin.posts.create')" class="btn bg-gradient-primary">
                        Cadastrar
                    </a>
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
                    <admin-tr v-for="post in posts" :key="post.id">
                        <component-td>
                            <div class="d-flex px-2">
                                <div class="my-auto">
                                    <h6 class="mb-0 text-sm">{{ post.name }}</h6>
                                </div>
                            </div>
                        </component-td>
                        <component-td>
                            <h6 class="mb-0 text-sm">{{ post.indicative_rating.name }}</h6>
                        </component-td>
                        <component-td>
                            <h6 class="mb-0 text-sm">{{ post.category.name }}</h6>
                        </component-td>
                        <component-td>
                            <span class="me-2 text-xs font-weight-bold">{{ post.note }}</span>
                        </component-td>
                        <component-td>
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="me-2 text-xs font-weight-bold">0%</span>
                                <div>
                                    <component-progress :number="0"/>
                                </div>
                            </div>
                        </component-td>
                        <component-td :class="'align-middle text-sm'">
                            <component-span-status :class="'bg-gradient-success'" v-if="post.active">Ativo</component-span-status>
                            <component-span-status :class="'bg-gradient-danger'" v-else>Desativado</component-span-status>
                        </component-td>
                        <component-td :class="'align-middle'">
                            <component-dropdown :name="'post-dropdown'">
                                <component-dropdown-item name="Visualizar" :route="route('admin.posts.show', post.id)"></component-dropdown-item>
                                <component-dropdown-item name="Editar" :route="route('admin.posts.edit', post.id)"></component-dropdown-item>
                                <component-dropdown-item name="Excluir" target="#destoryPost" @click="selectPost(post)" v-if="created"></component-dropdown-item>
                                <li><hr class="dropdown-divider"></li>
                                <component-dropdown-item name="Relatório Geral" :route="route('admin.report.general')"></component-dropdown-item>
                                <component-dropdown-item name="Relatório de Comentarios" :route="route('admin.report.comment')"></component-dropdown-item>
                            </component-dropdown>
                        </component-td>
                    </admin-tr>
                </template>
            </admin-table>
        </template>
    </component-card>

    <model :title="'Excluir Post'" :name="'destoryPost'">
        <div class="py-3 text-center">
            <i class="ni ni-bell-55 ni-3x"></i>
            <h4 class="text-gradient text-danger mt-4">Deseja excluir esse post?</h4>
            <p>Todos os comentarios, likes e deslikes relacionados a esse post será excluidos</p>
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
            created: {
                type: Boolean,
                default: false
            }
        },
        data(){
            return {
                token: '',
                category_id: '',
                indicative_rating_id: '',
                routeDelete: '',
                posts: [],
                post: {},
                indications: [],
                categories: [],
                selectedStatus: '',
                selectedIndicativeRating: '',
                selectedCategory: '',
                inputPost: '',
                listSearch: {},
            }
        },
        methods: {
            listCategories(){
                axios.get(route('api.categories.index'))
                    .then((response) => {
                        this.categories = response.data.data;
                    })
            },
            listIndications(){
                axios.get(route('api.indicative-rating.index'))
                    .then((response) => {
                        this.indications = response.data.data;
                    })
            },
            listPosts(){
                axios.get(route('api.admin.posts.index'))
                    .then((response) => {
                        this.posts = response.data.data;
                    })
            },
            selectPost(post){
                this.post = post;
                this.routeDelete = route('admin.posts.destroy', this.post.id);
            },
            destroy(){
                this.$refs.formDelete.submit();
            },
            filterIndicativeRating(event){
                this.selectedIndicativeRating = event.target.value;
                if(this.selectedIndicativeRating == ''){
                    this.listPosts();
                    return;
                }
                let params = {
                    'search': {
                        'indicative_rating_id' : this.selectedIndicativeRating
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.indicative_rating_id = this.selectedIndicativeRating
                }
                
                this.listSearch = params;
                this.search(params);
            },
            filterCategory(event){
                this.selectedCategory = event.target.value;
                if(this.selectedCategory == ''){
                    this.listPosts();
                    return;
                }
                let params = {
                    'search': {
                        'category_id' : this.selectedCategory
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.category_id = this.selectedCategory
                }
                
                this.listSearch = params;
                this.search(params);
            },
            filterSelectStatus(event){
                this.selectedStatus = event.target.value;
                if(this.selectedStatus == ''){
                    this.listPlans();
                    return;
                }
                let status = 0;

                if (this.selectedStatus == 'Ativo') {
                    status = 1
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
            searchInputPost(event){
                this.inputPost = event.target.value;
                if(this.inputPost == ''){
                    this.listPlans();
                    return;
                }
                let params = {
                    'search': {
                        'name' : this.inputPost
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.name = this.inputPost
                }
                
                this.listSearch = params;
                this.search(params);
            },
            search(params){
                axios.get(route('api.admin.posts.search'), {params})
                    .then((response) => {
                        this.posts = response.data.data;
                    })
            },
            clear(){
                this.selectedIndicativeRating = '';
                this.selectedStatus = '';
                this.selectedCategory = '';
                this.inputPost = '';
                this.listSearch = {}
                this.listPosts();
            }
        },
        mounted() {
            this.listCategories();
            this.listIndications();
            this.listPosts();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>