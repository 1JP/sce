<template>
    <model :title="title" :name="nameId">
        <div class="py-3 text-center">
            <h4 class="text-gradient text-danger mt-4">Deseja excluir esse Comentário?</h4>
            <p>Essa ação não pode ser desfeita.</p>
        </div>
        <form method="POST" :action="routeDelete" ref="formDelete">
            <input type="hidden" name="_token" :value="token"/>
            <input type="hidden" name="_method" value="DELETE" />
        </form>
        <template v-slot:footer>
            <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</a>
            <a :href="'#'" class="btn btn-primary" @click="destroy()">Sim</a>
        </template>
    </model>
</template>

<script>
    export default {
        data(){
            return {
                token: ''
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
            routeDelete: {
                type: String,
                required: false
            },
        },
        methods: {
            destroy(){
                this.$refs.formDelete.submit();
            },
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>
