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
                                <component-dropdown-item name="Responder" @click="selectComment(comment, false)"></component-dropdown-item>
                                <component-dropdown-item name="Editar" @click="selectComment(comment, true)" v-if="user.id == comment.user.id"></component-dropdown-item>
                                <component-dropdown-item name="Excluir" target="#destroyCommentModal" @click="deleteComment(comment)" v-if="user.id == comment.user.id"></component-dropdown-item>
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
            <site-create-comment v-if="createComment"
                :post_id="comment.post_id"
                :comment_id="comment_id"
                :user="user"
                :comment="contest"
            ></site-create-comment>
            <site-children-comment v-if="comment.children && Array.isArray(comment.children) && comment.children.length > 0" 
                :children="comment.children" :user="user"
            ></site-children-comment>
        </div>
    </div>

    <site-comment-destroy
        v-if="comment_id"
        :title="'Excluir Comentário'"
        :name-id="'destroyCommentModal'"
        :routeDelete='route("comments.destroy", comment_id)'
    />
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
        data() {
            return {
                createComment: false,
                comment_id: null,
                contest: '',
                routeDelete: ''
            }
        },
        components: {
            // A importação dinâmica ajuda a evitar problemas de dependência circular
            ChildrenComment: () => import('./ChildrenComment.vue'),
        },
        methods: {
             selectComment(comment, isEdit = false){
                this.createComment = true;
                this.comment_id = isEdit ? comment.comment_id : comment.id;
                this.contest = isEdit ? comment.description : '';
            },
            deleteComment(comment){
                this.comment_id = comment.id;
            },
        },
        mounted() {
            //
        }
    }
</script>
