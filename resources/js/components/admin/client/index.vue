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
                <div class="col-lg-3">
                    <h6>Clientes</h6>
                </div>
                <div class="col-lg-2 col-lg-3">
                    <admin-filter-select
                        :name="'Status'"
                        :value-select="selectedStatus"
                        :options="status"
                        @onChanged="filterSelectStatus($event)"
                    ></admin-filter-select>
                </div>
                <div class="col-lg-1 col-lg-3">
                    <div class="form-group input-group">
                        <admin-filter-input
                            :name="'Cliente...'"
                            :type="'text'"
                            :icon="'fa fa-search'"
                            :value-input="inputClient"
                            @input="searchInputClient($event)"
                        ></admin-filter-input>
                    </div>
                </div>
            </div>
        </template>
        <template v-slot:body>
            <admin-table :pagination="pagination" @page-change="listClients">
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
                    <admin-tr v-for="client in clients">
                        <component-td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ client.user.name }}</h6>
                                </div>
                            </div>
                        </component-td>
                        <component-td :class="'align-middle'">
                            <component-span-status :class="classStatus(client.user.subscription.status)">
                                {{ client.user.subscription.status }}
                            </component-span-status>
                        </component-td>
                        <component-td :class="'align-middle text-center text-sm'">
                            <span class="text-secondary text-xs font-weight-bold">{{ client.count_posts }}</span>
                        </component-td>
                        <component-td :class="'align-middle'">
                            <component-dropdown :name="'dropdown-index-client'">
                                <component-dropdown-item name="Visualizar" :route="route('admin.clientes.show', client.id)"></component-dropdown-item>
                                <component-dropdown-item name="Editar" :route="route('admin.clientes.edit', client.id)"></component-dropdown-item>
                                <component-dropdown-item name="Excluir" target="#destroyClient" @click="selectClient(client)"></component-dropdown-item>
                            </component-dropdown>
                        </component-td>
                    </admin-tr>
                </template>
            </admin-table>
        </template>
    </component-card>

    <model :title="'Excluir Cliente'" :name="'destroyClient'">
        <div class="py-3 text-center">
            <i class="ni ni-bell-55 ni-3x"></i>
            <h4 class="text-gradient text-danger mt-4">Deseja excluir esse cliente?</h4>
            <p>Todos os comentarios, likes e deslikes relacionados a esse cliente será excluidos</p>
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
            }
        },
        data(){
            return {
                clients: [],
                selectedStatus: '',
                inputClient: '',
                status: [
                    'TRIAL', 'ACTIVE',
                    'PENDING', 'PENDING_ACTION',
                    'OVERDUE', 'EXPIRED',
                    'CANCELED', 'SUSPENDED'
                ],
                listSearch: {},
                pagination: null,
                routeDelete: '',
                token: ''
            }
        },
        methods: {
            listClients(page = 1){
                if(Object.keys(this.listSearch).length > 0){
                    this.listSearch.page = page
                    this.search(this.listSearch)
                    return
                }
                axios.get(route('api.admin.client.index'), { params: { page } })
                    .then((response) => {
                        this.clients = response.data.data;
                        this.pagination = response.data.meta
                    })
            },
            classStatus(status) {
                switch (status) {
                    case 'TRIAL':
                    case 'ACTIVE':
                        return 'bg-gradient-success';
                    case 'PENDING':
                    case 'PENDING_ACTION':
                        return 'bg-gradient-warning';
                    case 'OVERDUE':
                    case 'EXPIRED':
                    case 'CANCELED':
                    case 'SUSPENDED':
                        return 'bg-gradient-danger';
                    default:
                        return '';
                }
            },
            filterSelectStatus(event){
                this.selectedStatus = event.target.value;
                if(this.selectedStatus == ''){
                    this.listClients();
                    return;
                }
                
                let params = {
                    'search': {
                        'status' : this.selectedStatus
                    }
                };

                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.status = this.selectedStatus
                }
                
                this.listSearch = params;
                this.search(params);
            },
            searchInputClient(event){
                this.inputClient = event.target.value;
                let params = {
                    'search': {
                        'name' : this.inputClient
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.name = this.inputClient
                }
                
                this.listSearch = params;
                this.search(params);
            },
            search(params){
                axios.get(route('api.admin.client.search'), {params})
                    .then((response) => {
                        this.clients = response.data.data;
                        this.pagination = response.data.meta
                    })
            },
            selectClient(client){
                this.routeDelete = route('admin.clientes.destroy', client.id)
            },
            destroy(){
                this.$refs.formDelete.submit();
            }
        },
        mounted() {
            this.listClients();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>