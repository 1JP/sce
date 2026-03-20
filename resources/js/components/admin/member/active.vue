<template>
    <div class="py-5 text-center">
        <div class="p-5 col-lg-6 col-10 mx-auto bg-light border-0 shadow-sm">
            <h3 class="mb-4 pb-4">Primeiro Acesso</h3>
            <form method="POST" :action="routeCreate" ref="form">
                <input type="hidden" name="_token" :value="token"/>
                <input type="hidden" name="token" :value="hashToken" />
                <div class="form-group"> 
                    <label>E-mail<br></label>
                    <component-input
                        :required="true"
                        :input-type="'email'"
                        :placeholder="'E-mail'"
                        :name-id="'email'"
                        :value="email"
                    /> 
                </div>
                <div class="form-group"> 
                    <label>Senha</label>
                    <component-input
                        :required="true"
                        :input-type="'password'"
                        :placeholder="'Senha'"
                        :name-id="'password'"
                        :value="password"
                        :class-input="classPassword"
                        @input="valuePassword($event)"
                    />
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-primary btn-block rounded w-100" @click="save()">
                            Salvar
                        </button>
                    </div>
                    <div class="col-lg-6">
                        <a :href="route('login')" class="btn btn-segund btn-block rounded w-100" >
                            Voltar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        props: {
            email: {
                type: String,
                required: true,
            },
            hashToken: {
                type: String,
                required: true,
            },
        },
        data(){
            return {
                token: '',
                password: '',
                classPassword: '',
                routeCreate: route('store-ative-member'),
            }
        },
        methods: {
            valuePassword(event){
                this.password = event.target.value;
            },
            save(){
                if(this.password == ''){
                    this.classPassword = this.name == '' ? 'is-invalid' : 'is-valid'

                    return;
                }

                this.classPassword = 'is-valid'
                
                this.$refs.form.submit();
            },
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>