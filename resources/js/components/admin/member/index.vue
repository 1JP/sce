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
                <div class="col-lg-2">
                    <h6>Membros</h6>
                </div>
                <div class="col-lg-1 col-lg-3">
                    <div class="form-group input-group">
                        <admin-filter-input
                            :name="'Nome...'"
                            :type="'text'"
                            :icon="'fa fa-search'"
                            :value-input="inputName"
                            @input="searchInputName($event)"
                        ></admin-filter-input>
                    </div>
                </div>
                <div class="col-lg-1 col-lg-3">
                    <div class="form-group input-group">
                        <admin-filter-input
                            :name="'E-mail...'"
                            :type="'text'"
                            :icon="'fa fa-search'"
                            :value-input="inputEmail"
                            @input="searchInputEmail($event)"
                        ></admin-filter-input>
                    </div>
                </div>
                <div class="col-lg-4 d-flex justify-content-end">
                    <button type="button" class="btn bg-gradient-primary me-2" @click="clear()" v-if="Object.keys(listSearch).length > 0">
                        Limpar filtros
                    </button>
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createMemberModal">
                        Cadastrar
                    </button>
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
                    <admin-tr v-for="member in members">
                        <component-td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ member.name }}</h6>
                                </div>
                            </div>
                        </component-td>
                        <component-td>
                            <h6 class="mb-0 text-sm">{{ member.email }}</h6>
                        </component-td>
                        <component-td :class="'align-middle text-center text-sm'">
                            <span class="text-secondary text-xs font-weight-bold">{{ maskPhoneNumber(member.area+member.phone) }}</span>
                        </component-td>
                        <component-td :class="'align-middle'">
                            <component-dropdown :name="'dropdown-index-client'">
                                <component-dropdown-item name="Editar" target="#editMembroModal" @click="selectMember(member)"></component-dropdown-item>
                                <component-dropdown-item name="Excluir" target="#destroyMemberModal"></component-dropdown-item>
                            </component-dropdown>
                        </component-td>
                    </admin-tr>
                </template>
            </admin-table>
        </template>
    </component-card>

    <model :title="'Editar Membro'" :name="'editMembroModal'">
        <form method="POST" :action="routeUpdate" ref="formUpdate">
            <input type="hidden" name="_token" :value="token"/>
            <input type="hidden" name="_method" value="PATCH" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <component-input
                            :required="true"
                            :input-type="'text'"
                            :placeholder="'Nome'"
                            :name-id="'name'"
                            :value="name"
                            :class-input="classInput"
                            @input="valueInput($event)"
                        />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <component-input
                        :required="true"
                        :input-type="'email'"
                        :placeholder="'E-mail'"
                        :name-id="'email'"
                        :value="email"
                        :class-input="classEmail"
                        @input="valueEmail($event)"
                    />
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <component-input
                        :required="true"
                        :input-type="'text'"
                        :placeholder="'Telefone'"
                        :name-id="'phone'"
                        :value="phone"
                        pattern="[0-9]*"
                        :max-length="'15'"
                        :class-input="classPhone"
                        @input="valuePhone($event)"
                    />
                </div>
            </div>
        </form>
        <template v-slot:footer>
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn bg-gradient-primary" @click="save()">Editar</button>
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
                members: [],
                member: {},
                classInput: '',
                classEmail: '',
                classPhone: '',
                email: '',
                name: '',
                phone: '',
                routeUpdate: '',
                routeDelete: '',
                inputName: '',
                inputEmail: '',
                listSearch: {},
            }
        },
        methods: {
            listMembers(){
                axios.get(route('api.admin.members.index'))
                    .then((response) => {
                        this.members = response.data.data;
                    })
            },
            selectMember(member){
                this.member = member;
                this.routeUpdate = route('admin.membros.update', this.member.id);
                this.routeDelete = route('admin.membros.destroy', this.member.id);
                this.name = this.member.name;
                this.phone = this.maskPhoneNumber(this.member.area+this.member.phone);
                this.email = this.member.email;
            },
            maskPhoneNumber(string){
                string = string.replace(/\D/g, '');
                if (string.length === 11) {
                    string = string.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
                } else {
                    string = string.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
                }

                return string;
            },
            isEmail(value) {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(value);
            },
            valueInput(event){
                this.name = event.target.value;
            },
            valueEmail(event){
                if (! this.isEmail(event.target.value)) {
                    this.classEmail = 'is-invalid'
                    return
                }else{
                    this.classEmail = ''
                }

                this.email = event.target.value;
            },
            valuePhone(event){
                if(/^[a-zA-Z]$/.test(event.target.value)){
                    this.phone = null;
                    return;
                }
                this.phone = this.maskPhoneNumber(event.target.value);
            },
            save(){
                if(this.name == '' || this.email == ''){
                    this.classInput = this.name == '' ? 'is-invalid' : 'is-valid'
                    this.classEmail = this.email == '' ? 'is-invalid' : 'is-valid'
                    this.classPhone = this.phone == '' ? 'is-invalid' : 'is-valid'

                    return;
                }
                
                if (! this.isEmail(this.email)) {
                    this.classEmail = 'is-invalid'
                    return
                }else{
                    this.classEmail = ''
                }

                this.classInput = 'is-valid'
                this.classEmail = 'is-valid'
                this.classPhone = 'is-valid'
                this.$refs.formUpdate.submit();
            },
            searchInputName(event){
                this.inputName = event.target.value;
                if(this.inputName == '' && this.inputEmail == ''){
                    this.listMembers();
                    return;
                }
                let params = {
                    'search': {
                        'name' : this.inputName
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.name = this.inputName
                }
                
                this.listSearch = params;
                this.search(params);
            },
            searchInputEmail(event){
                this.inputEmail = event.target.value;
                if(this.inputEmail == '' && this.inputName == ''){
                    this.listMembers();
                    return;
                }
                let params = {
                    'search': {
                        'email' : this.inputEmail
                    }
                };
                
                if(Object.keys(this.listSearch).length > 0){
                    params.search = Object.assign({}, params.search, this.listSearch.search);
                    params.search.email = this.inputEmail
                }
                
                this.listSearch = params;
                this.search(params);
            },
            search(params){
                axios.get(route('api.admin.members.search'), {params})
                    .then((response) => {
                        this.members = response.data.data;
                    })
            },
            clear(){
                this.inputName = '',
                this.inputEmail = '',
                this.listSearch = {}
                this.listMembers();
            }
        },
        mounted() {
            this.listMembers()
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>