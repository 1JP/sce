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
                <div class="col-lg-4">
                    <h6>Permissões</h6>
                </div>
                <div class="col-lg-1 col-lg-3">
                    <div class="form-group input-group">
                        <admin-filter-input
                            :name="'Permissão...'"
                            :type="'text'"
                            :icon="'fa fa-search'"
                        ></admin-filter-input>
                    </div>
                </div>
                <div class="col-lg-5 d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-primary h-50" data-bs-toggle="modal" data-bs-target="#createPermissionModal">
                        Cadastrar
                    </button>
                </div>
            </div>
        </template>
        <template v-slot:body>
            <admin-table :pagination="pagination" @page-change="permissions">
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
                    <admin-tr v-for="role in roles" :key="role.id">
                        <component-td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ role.name }}</h6>
                                </div>
                            </div>
                        </component-td>
                        <component-td :class="'align-middle text-center text-sm'">
                            <span class="text-secondary text-xs font-weight-bold">{{ role.count }}</span>
                        </component-td>
                        <component-td :class="'align-middle'">
                            <component-dropdown :name="'dropdown-index-client'" v-if="role.name != 'Root'">
                                <component-dropdown-item name="Editar" target="#editPermissionModal" @click="editPermission(role)"></component-dropdown-item>
                                <component-dropdown-item name="Excluir" target="#destroyPermissionModal" @click="deletePermission(role)"></component-dropdown-item>
                            </component-dropdown>
                        </component-td>
                    </admin-tr>
                </template>
            </admin-table>
        </template>
    </component-card>

    <admin-permission-create
        :title="'Cadastrar Permissão'"
        :name-id="'createPermissionModal'"
    />

    <model :title="'Editar Permissão'" :name="'editPermissionModal'">
        <form method="POST" :action="routeUpdate" ref="formUpdate">
            <input type="hidden" name="_token" :value="token"/>
            <input type="hidden" name="_method" value="PATCH" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <component-input
                            :required="true"
                            :input-type="'text'"
                            :placeholder="'Permissão'"
                            :name-id="'name'"
                            :value="name"
                            :class-input="classInput"
                            @input="valueInput($event)"
                        />
                    </div>
                </div>
            </div>
        </form>
        <template v-slot:footer>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn bg-gradient-primary" @click="save()">Salvar</button>
        </template>
    </model>

    <model :title="'Excluir Permissão'" :name="'destroyPermissionModal'">
        <div class="py-3 text-center">
            <i class="ni ni-bell-55 ni-3x"></i>
            <h4 class="text-gradient text-danger mt-4">Deseja excluir essa Permissão?</h4>
            <p>Todos os usuários relacionados a essa Permissão perderam suas autorizações do sistema</p>
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
        },
        data(){
            return {
                token: '',
                roles: [],
                role: null,
                pagination: null,
                name: '',
                listSearch: {},
                routeUpdate: route('admin.permissoes.update', ':id'),
                routeDelete: route('admin.permissoes.destroy', ':id'),
                classInput: ''
            }
        },
        methods: {
            permissions(page = 1){
                axios.get(route('api.admin.roles.index'), { params: { page } })
                    .then((response) => {
                        this.roles = response.data.data
                        this.pagination = response.data.meta
                    })
            },
            editPermission(role){
                this.role = role;
                this.name = role.name;
                this.routeUpdate = route('admin.permissoes.update', this.role.id);
            },
            deletePermission(role){
                this.role = role;
                this.routeDelete = route('admin.permissoes.destroy', this.role.id);
            },
            valueInput(event){
                this.name = event.target.value;
            },
            save(){
                if(this.name == ''){
                    this.classInput = this.name == '' ? 'is-invalid' : 'is-valid'
                    return;
                }
                
                this.classInput = 'is-valid'
                this.$refs.formUpdate.submit();
            },
            destroy(){
                this.$refs.formDelete.submit();
            },
            searchInputRole(value) {
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
            search(params){
                axios.get(route('api.admin.logs.search'), {params})
                    .then((response) => {
                        this.logs = response.data.data
                        this.pagination = response.data.meta
                    })
            },
            clear(){
                this.name = '',
                this.listSearch = {}
            }
        },
        mounted() {
            this.permissions();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>