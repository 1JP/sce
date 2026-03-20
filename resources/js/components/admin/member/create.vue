<template>

    <model :title="title" :name="nameId">
        <form method="POST" :action="routeCreate" ref="form">
            <input type="hidden" name="_token" :value="token"/>
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
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn bg-gradient-primary" @click="save()">Salvar</button>
        </template>
    </model>
</template>

<script>
    export default {
        data(){
            return {
                token: '',
                classInput: '',
                classEmail: '',
                classPhone: '',
                email: '',
                name: '',
                phone: '',
                routeCreate: route('admin.membros.store')
            }
        },
        props: {
            title: {
                type: String,
                required: true,
            }, 
            nameId: {
                type: String,
                required: true,
            }
        },
        methods: {
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
                this.$refs.form.submit();
            },
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>
