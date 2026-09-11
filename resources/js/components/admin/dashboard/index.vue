<template>
    <div class="row mt-4">
        <div class="col-lg-6 mb-lg-0 mb-4">
            <component-card
                :class-card="'z-index-2 h-100'"
                :card-header="true"
                :class-header="'pb-0 pt-3 bg-transparent'"
                :card-body="true"
                :class-body="'p-3'"
            >
                <template v-slot:header>
                    <h6 class="text-capitalize">Comentários</h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success" v-if="commentTrend"></i>
                        <i class="fa fa-arrow-down text-danger" v-else></i>
                        <span class="font-weight-bold">{{ commentTrendPercentage }}% more</span> in {{ currentYear }}
                    </p>
                </template>
                <template v-slot:body>
                    <admin-chart-line
                        :labels='labels'
                        :datasets='commentDatasets'
                    ></admin-chart-line>
                </template>
            </component-card>
        </div>
        <div class="col-lg-6">
            <component-card
                :class-card="'z-index-2 h-100'"
                :card-header="true"
                :class-header="'pb-0 pt-3 bg-transparent'"
                :card-body="true"
                :class-body="'p-3'"
            >
                <template v-slot:header>
                    <h6 class="text-capitalize">
                        Like 
                        <span class="badge rounded-circle" style="background-color: rgba(51, 255, 87, 0.2); width: 12px; height: 12px; display: inline-block;"></span> 
                        Deslike
                        <span class="badge rounded-circle" style="background-color: rgba(255, 87, 51, 0.2); width: 12px; height: 12px; display: inline-block;"></span>
                    </h6>
                    <p class="text-sm mb-0">
                        <i class="fa fa-arrow-up text-success" v-if="linkTrend"></i>
                        <i class="fa fa-arrow-down text-danger" v-else></i>
                        <span class="font-weight-bold">{{ linkTrendPercentage }}% more</span> in {{ currentYear }}
                    </p>
                </template>
                <template v-slot:body>
                    <admin-chart-line
                        :labels='labels'
                        :datasets='linkDeslinkDatasets'
                    ></admin-chart-line>
                </template>
            </component-card>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <component-card
                :card-header="true"
                :class-header="'pb-0 p-3'"
                :card-body="true"
                :class-body="'pb-0 p-1'"
            >
                <template v-slot:header>
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Posts</h6>
                    </div>
                </template>
                <template v-slot:body>
                    <admin-table>
                        <template v-slot:tbody>
                            <tr v-for="post in posts" :key="post.id">
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                        <p class="text-xs font-weight-bold mb-0">Post:</p>
                                        <h6 class="text-sm mb-0">{{ post.name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Link:</p>
                                        <h6 class="text-sm mb-0">{{ post.likes?.length }}</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Deslink:</p>
                                        <h6 class="text-sm mb-0">{{ post.dislikes?.length }}</h6>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Comentários positivo:</p>
                                        <h6 class="text-sm mb-0">{{ post.positive_comments_percentage }}%</h6>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Comentários negativo:</p>
                                        <h6 class="text-sm mb-0">{{ post.negative_comments_percentage }}%</h6>
                                    </div>
                                </td>
                                <td class="align-middle text-sm">
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Comentários neutro:</p>
                                        <h6 class="text-sm mb-0">{{ post.neutral_comments_percentage }}%</h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a :href="route('admin.posts.show', post.id)" class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                            <i class="ni ni-bold-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </admin-table>
                </template>
            </component-card>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        data(){
            return {
                posts: [],
                labels: [
                    'Janeiro','Fevereiro','Março','Abril','Maio','Junho',
                    'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'
                ],
                currentYear: new Date().getFullYear(),
                commentDatasets: [],
                commentTrend: false,
                linkTrend: false,
                commentTrendPercentage: 0,
                linkTrendPercentage: 0,
                linkDeslinkDatasets: [],
                linkDatasets: {
                    label: 'Like',
                    data: [],
                    borderColor: '#33FF57',
                    backgroundColor: 'rgba(51, 255, 87, 0.2)',
                    tension: 0.4,
                },
                deslinkDatasets: {
                    label: 'Deslike',
                    data: [],
                    borderColor: '#FF5733',
                    backgroundColor: 'rgba(255, 87, 51, 0.2)',
                    tension: 0.4,
                },
            }
        },
        methods: {
            listPosts(){
                axios.get(route('api.admin.posts.index'))
                    .then((response) => {
                        this.posts = response.data.data;
                    })
            },
            normalizeLinkDeslinkDatasets() {
                this.linkDeslinkDatasets = [
                    { ...this.linkDatasets, data: Array.isArray(this.linkDatasets.data) ? this.linkDatasets.data : [] },
                    { ...this.deslinkDatasets, data: Array.isArray(this.deslinkDatasets.data) ? this.deslinkDatasets.data : [] },
                ];
            },
            commentChartLine(){
                axios.get(route('api.comments.chartline', { year: this.currentYear }))
                    .then((response) => {
                        this.commentDatasets = response.data.counts;
                        this.commentTrend = response.data.trend === 'positive';
                        this.commentTrendPercentage = response.data.percentage_increase;
                    })
            },
            linkChartLine(){
                return axios.get(route('api.links.chartline', { year: this.currentYear }))
                    .then((response) => {
                        this.linkDatasets.data = Array.isArray(response.data.counts) ? response.data.counts : [];
                        this.linkTrend = response.data.trend === 'positive';
                        this.linkTrendPercentage = response.data.percentage_increase;
                    })
                    .catch(() => {
                        this.linkDatasets.data = [];
                    });
            },
            deslinkChartLine(){
                return axios.get(route('api.deslinks.chartline', { year: this.currentYear }))
                    .then((response) => {
                        this.deslinkDatasets.data = Array.isArray(response.data.counts) ? response.data.counts : [];
                    })
                    .catch(() => {
                        this.deslinkDatasets.data = [];
                    });
            },
            loadReactionCharts() {
                Promise.all([
                    this.linkChartLine(),
                    this.deslinkChartLine(),
                ]).then(() => {
                    this.normalizeLinkDeslinkDatasets();
                });
            },
        },
        mounted() {
            this.listPosts();
            this.commentChartLine();
            this.loadReactionCharts();
        }
    }
</script>