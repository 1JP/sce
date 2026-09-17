<template>
    <component-card
        :class-card="'shadow-lg border'"
        :card-body="true"
    >
        <template v-slot:body>
            <form class="" method="POST" ref="form" :action="route('admin.profiles.store')">
                <input type="hidden" name="_token" :value="token"/>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group"> 
                            <label>Nome</label>
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'Nome completo'"
                                :name-id="'name'"
                                :value="name"
                                :class-input="className"
                                @input="inputName($event)"
                            />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"> 
                            <label>E-mail</label>
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'E-mail'"
                                :name-id="'email'"
                                :value="email"
                                :class-input="classEmail"
                                @input="inputEmail($event)"
                            /> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group"> 
                            <label>Password</label> 
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'Password'"
                                :name-id="'password'"
                                :value="password"
                                :class-input="classPassword"
                                @input="inputPassword($event)"
                            /> 
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"> 
                            <label>CPF</label> 
                            <component-input
                                :required="true"
                                :input-type="'text'"
                                :placeholder="'125.456.789-00'"
                                :name-id="'cpf'"
                                :value="cpf"
                                :class-input="classCpf"
                                :max-length="'14'"
                                @input="inputCpf($event)"
                            /> 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 d-flex p-3 ml-auto justify-content-end align-items-center flex-row">
                        <a class="btn btn-outline-primary m-1" :href="route('admin.dashboard')">Cancelar</a>
                        <a class="btn btn-primary m-1" href="#" @click="save">Salvar alterações</a>
                    </div>
                </div>
            </form>
        </template>
    </component-card>
</template>

<script>
    import axios from 'axios';

    export default {
        data(){
            return {
                token: '',
                name: '',
                className: '',
                email: '',
                classEmail: '',
                password: '',
                classPassword: '',
                cpf: '',
                classCpf: '',
            }
        },
        methods: {
            profile(){
                axios.get(route('api.admin.profiles.index'))
                    .then(response => {
                        const profile = response.data.data;
                        this.name = profile.name;
                        this.email = profile.email;
                        this.cpf = this.maskCpf(profile.cpf);
                    })
                    .catch(error => {
                        console.error('Error fetching profile:', error);
                    });
            },
            inputName(event){
                this.name = event.target.value;
            },
            inputEmail(event){
                this.email = event.target.value;
            },
            inputPassword(event){
                this.password = event.target.value;
            },
            inputCpf(event){
                event.target.value = event.target.value.replace(/\D/g, '');
                this.cpf = this.maskCpf(event.target.value);
            },
            maskCpf(string){
                string = string.replace(/\D/g, '');
                if (string.length > 3 && string.length <= 6) {
                    string = string.replace(/^(\d{3})(\d)/, '$1.$2');
                } else if (string.length > 6 && string.length <= 9) {
                    string = string.replace(/^(\d{3})(\d{3})(\d)/, '$1.$2.$3');
                } else if (string.length > 9 && string.length <= 11) {
                    string = string.replace(/^(\d{3})(\d{3})(\d{3})(\d)/, '$1.$2.$3-$4');
                }

                return string;
            },
            save(){
                if(this.name == '' || this.email == '' || this.cpf == ''){
                    this.className = this.name == '' ? 'is-invalid' : 'is-valid'
                    this.classEmail = this.email == '' ? 'is-invalid' : 'is-valid'
                    this.classCpf = this.cpf == '' ? 'is-invalid' : 'is-valid'

                    return;
                }

                this.className = 'is-valid'
                this.classEmail = 'is-valid'
                this.classPassword = 'is-valid'
                this.classCpf = 'is-valid'

                this.$refs.form.submit();
            }
        },
        mounted() {
            this.profile();
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>