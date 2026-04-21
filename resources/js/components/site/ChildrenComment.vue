<template>
    <div class="children-comment">
        <div class="mb-4 hover-actions-trigger btn-reveal-trigger" v-for="comment in children" :key="comment.id">
            <div class="row">
                <div class="col-lg-6">
                    <p class="text-body-tertiary fs-9 mb-1">{{ comment.user.name }}</p>
                    <p class="text-body-tertiary fs-9 mb-1">{{ comment.updated_at  }}</p>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <div class="hover-actions-trigger top-0 btn-cell">
                        <div class="btn-group">
                            <component-dropdown :name="'dropdown-comment'" 
                                :class-button="'btn btn-outline-primary btn-sm p-0 rounded-circle'"
                                :icon="'bi bi-three-dots'"
                                >
                                <component-dropdown-item name="Responder" route="#"></component-dropdown-item>
                                <component-dropdown-item name="Editar" route="#" v-if="user.id == comment.user.id"></component-dropdown-item>
                                <component-dropdown-item name="Excluir" route="#" v-if="user.id == comment.user.id"></component-dropdown-item>
                            </component-dropdown>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-body-highlight mb-1">
                {{ comment.description }}
            </p>

            <div class="hover-actions-trigger top-0">
                <a class="me-2">
                    <i class="bi bi-hand-thumbs-up"></i>
                    4
                </a>
                <a class="me-1">
                    <i class="bi bi-hand-thumbs-down"></i>
                    5
                    </a>
                <a class="me-2">
                    <i class="bi bi-chat-square-text-fill"></i>
                    1
                </a>
            </div>
            <site-create-comment v-if="false"></site-create-comment>
        </div>
        <div v-if="children && Array.isArray(children) && children.length > 0">
            <component :is="ChildrenComment"/>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'ChildrenComment',
        props: {
            children: {
                type: Array,
                default: () => [], // Garante que a lista de filhos seja um array vazio por padrão
            },
            user: {
                type: Object,
                required: false
            }
        },
        components: {
            // A importação dinâmica ajuda a evitar problemas de dependência circular
            ChildrenComment: () => import('./ReplyComment.vue'),
        },
        methods: {
            //
        },
        mounted() {
            console.log(this.children)
        }
    }
</script>
