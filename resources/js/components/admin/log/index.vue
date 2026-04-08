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
                    <h6>Logs</h6>
                </div>
                <div class="col-lg-1 col-lg-1">
                    <div class="form-group">
                        <admin-filter-select
                            :name="'Ação'"
                            :options="actions"
                            :value-select="action"
                            @onChanged="filterSelect($event)"
                        ></admin-filter-select>
                    </div>
                </div>
                <div class="col-lg-1 col-lg-3">
                    <div class="form-group input-group">
                        <admin-filter-input
                            :name="'Usuário...'"
                            :type="'text'"
                            :icon="'fa fa-search'"
                            :value-input="name"
                            @input="searchInputUser($event)"
                        ></admin-filter-input>
                    </div>
                </div>
                <div class="col-lg-1 col-lg-3">
                    <div class="form-group input-group">
                        <admin-filter-input
                            :type="'date'"
                            :value-input="from"
                            @input="searchInputFrom($event)"
                        >
                        De:
                        </admin-filter-input>
                    </div>
                </div>
                <div class="col-lg-1 col-lg-3">
                    <div class="form-group input-group">
                        <admin-filter-input
                            :type="'date'"
                            :value-input="to"
                            @input="searchInputTo($event)"
                        >
                        Para:
                        </admin-filter-input>
                    </div>
                </div>
                <div class="col-lg-12 col-lg-5 d-flex justify-content-end align-items-center">
                    <button type="button" class="btn bg-gradient-primary me-2" @click="clear()" v-if="Object.keys(listSearch).length > 0">
                        Limpar filtros
                    </button>
                </div>
            </div>
        </template>
        <template v-slot:body>
            <admin-table :pagination="pagination" @page-change="activity">
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
                    <admin-tr v-for="log in logs" :key="log.id">
                        <component-td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ log.causer?.name }}</h6>
                                </div>
                            </div>
                        </component-td>
                        <component-td>
                            <h6 class="mb-0 text-sm">{{ log.subject_type }}</h6>
                        </component-td>
                        <component-td :class="'align-middle text-center text-sm'">
                            <h6 class="mb-0 text-sm">{{ log.description }}</h6>
                        </component-td>
                        <component-td :class="'align-middle text-center'">
                            <component-span-status :class="classStatus(log.description)">
                                {{ log.created_at }}
                            </component-span-status>
                        </component-td>
                        <component-td :class="'align-middle'">
                            <component-dropdown :name="'dropdown-index'">
                                <component-dropdown-item name="Visualizar" :route="route('admin.logs.show', log.id)"/>
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
                logs: [],
                pagination: null,
                action: '',
                actions: [
                    'Criado',
                    'Atualizado',
                    'Deletado',
                ],
                name: '',
                from: '',
                to: '',
                listSearch: {}
            }
        },
        methods: {
            activity(page = 1){
                axios.get(route('api.admin.logs.index'), { params: { page } })
                    .then((response) => {
                        this.logs = response.data.data
                        this.pagination = response.data.meta
                    })
            },
            classStatus(status) {
                switch (status) {
                    case 'created':
                        return 'bg-gradient-success';
                    case 'updated':
                        return 'bg-gradient-warning';
                    case 'deleted':
                        return 'bg-gradient-danger';
                    default:
                        return '';
                }
            },
            filterSelect(value) {
                this.action = value.target.value;
                let params = {
                    'search': {
                        'action' : this.action
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.action = this.action
                }
                
                this.listSearch = params;
                this.search(this.listSearch)
            },
            searchInputUser(value) {
                this.name = value.target.value;
                let params = {
                    'search': {
                        'name' : this.name
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.name = this.name
                }
                
                this.listSearch = params;
                this.search(this.listSearch)
            },
            searchInputFrom(value) {
                this.from = value.target.value;
                let params = {
                    'search': {
                        'from' : this.from
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.from = this.from
                }
                
                this.listSearch = params;
                this.search(this.listSearch)
            },
            searchInputTo(value) {
                this.to = value.target.value;
                let params = {
                    'search': {
                        'to' : this.to
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.to = this.to
                }
                
                this.listSearch = params;
                this.search(this.listSearch)
            },
            search(params){
                axios.get(route('api.admin.logs.search'), {params})
                    .then((response) => {
                        this.logs = response.data.data
                        this.pagination = response.data.meta
                    })
            },
            clear(){
                this.action = '',
                this.name = '',
                this.from = '',
                this.to = '',
                this.listSearch = {}
                this.activity();
            }
        },
        mounted() {
            this.activity();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>