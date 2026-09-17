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
</template>

<script>
    export default {
        data(){
            return {
                classInput: '',
                name: '',
                token: '',
                routeCreate: route('admin.permissoes.store')
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
            },
        },
        methods: {
            valueInput(event){
                this.name = event.target.value;
            },
            save(){
                if(this.name == ''){
                    this.classInput = this.name == '' ? 'is-invalid' : 'is-valid'
                    return;
                }
                
                this.classInput = 'is-valid'
                this.$refs.form.submit();
            },
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>
