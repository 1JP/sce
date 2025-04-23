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
                <div class="col-lg-1 col-lg-3">
                    <admin-filter-select
                        :name="'Classificação Indicativa'"
                        :options="indications"
                        :value-select="indicative_rating_id"
                    ></admin-filter-select>
                </div>
                <div class="col-lg-1 col-lg-3">
                    <admin-filter-input
                        :name="'Post...'"
                        :type="'text'"
                        :icon="'fa fa-search'"
                    ></admin-filter-input>
                </div>
                <div class="col-lg-1 col-lg-3">
                    <admin-filter-select
                        :name="'Categoria'"
                        :options="categories"
                        :value-select="category_id"
                    ></admin-filter-select>
                </div>
                <div class="col-lg-2 d-flex justify-content-end">
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
                    <!-- v-for="post in posts" :key="post.id" -->
                    <admin-tr>
                        <component-td>
                            <div class="d-flex px-2">
                                <div class="my-auto">
                                <h6 class="mb-0 text-sm">Spotify</h6>
                                </div>
                            </div>
                        </component-td>
                        <component-td>
                            <h6 class="mb-0 text-sm">Spotify</h6>
                        </component-td>
                        <component-td>
                            <h6 class="mb-0 text-sm">Spotify</h6>
                        </component-td>
                        <component-td>
                            <span class="me-2 text-xs font-weight-bold">60</span>
                        </component-td>
                        <component-td>
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="me-2 text-xs font-weight-bold">0%</span>
                                <div>
                                    <component-progress :number="0"/>
                                </div>
                            </div>
                        </component-td>
                        <component-td :class="'align-middle'">
                            <component-dropdown :name="'post-dropdown'">
                                <component-dropdown-item name="Visualizar" :route="route('admin.posts.show', 1)"></component-dropdown-item>
                                <component-dropdown-item name="Editar" :route="route('admin.posts.edit', 1)"></component-dropdown-item>
                                <component-dropdown-item name="Excluir" target="#destoryPost"></component-dropdown-item>
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
                token: '',
                category_id: '',
                indicative_rating_id: '',
                posts: [],
                indications: [],
                categories: [],
            }
        },
        methods: {
            listCategories(){
                axios.get(route('api.admin.categories.index'))
                    .then((response) => {
                        this.categories = response.data.data;
                    })
            },
            listIndications(){
                axios.get(route('api.admin.indicative-rating.index'))
                    .then((response) => {
                        this.indications = response.data.data;
                    })
            },
        },
        mounted() {
            this.listCategories();
            this.listIndications();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>