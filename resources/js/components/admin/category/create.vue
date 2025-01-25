<template>

    <model :title="title" :name="nameId">
        <form method="POST" :action="routeCreate" ref="form">
            <input type="hidden" name="_token" :value="token"/>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <component-input
                            :required="true"
                            :input-type="'name'"
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
                    <component-select
                        :is-required="true"
                        :placeholder="'Classificação Indicativas'"
                        :name-id="'category_type_id[]'"
                        :is-mutiple="true"
                        :options='types'
                        :class-item="classItem"
                        @onChanged="valueSelect($event)"
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
                classInput: '',
                classItem: '',
                categoryTypeIds: '',
                name: '',
                token: '',
                routeCreate: route('admin.categorias.store')
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
            types: {
                type: Array,
                default: () => []
            }
        },
        methods: {
            valueSelect(event){
                this.categoryTypeIds = event.target.value;
            },
            valueInput(event){
                this.name = event.target.value;
            },
            save(){
                if(this.name == '' || this.categoryTypeIds == ''){
                    this.classInput = this.name == '' ? 'is-invalid' : 'is-valid'
                    this.classItem = this.categoryTypeIds == '' ? 'is-invalid' : 'is-valid'
                    return;
                }
                
                this.classInput = 'is-valid'
                this.classItem = 'is-valid'
                this.$refs.form.submit();
            },
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>
