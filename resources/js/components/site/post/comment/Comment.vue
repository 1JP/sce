<template>
    <div class="mb-4 hover-actions-trigger btn-reveal-trigger" v-for="comment in comments" :key="comment.id">
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
                            <component-dropdown-item name="Editar" @click="selectComment(comment, true)" v-if="user?.id == comment.user.id"></component-dropdown-item>
                            <component-dropdown-item name="Excluir" target="#destroyCommentModal" @click="deleteComment(comment)" v-if="user?.id == comment.user.id"></component-dropdown-item>
                        </component-dropdown>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-body-highlight mb-1">
            {{ comment.description }}
        </p>
        <div class="hover-actions-trigger top-0">
            <a class="me-2" @click="link(comment)">
                <i class="bi bi-hand-thumbs-up"></i>
                {{ comment.countLinks }}
            </a>
            <a class="me-2" @click="deslink(comment)">
                <i class="bi bi-hand-thumbs-down"></i>
                {{ comment.countDesLinks }}
            </a>
            <a class="me-2" @click="showComment(comment.id)">
                <i class="bi bi-chat-square-text-fill"></i>
                {{ comment.countComments }}
            </a>
        </div>
        <site-create-comment v-if="createComment"
            :post_id="post_id"
            :comment_id="comment_id"
            :user="user"
            :comment="contest"
        ></site-create-comment>
        <site-children-comment 
            v-if="comment.children && Array.isArray(comment.children) 
            && comment.children.length > 0 && expandedComments.includes(comment.id)"
            :children="comment.children" 
            :user="user"
        ></site-children-comment>
    </div>

    <site-comment-destroy
        v-if="comment_id"
        :title="'Excluir Comentário'"
        :name-id="'destroyCommentModal'"
        :routeDelete='route("comments.destroy", comment_id)'
    />
</template>

<script>
import { comment } from 'postcss';

    export default {
        props: {
            post_id: {
                type: Number,
                required: false
            },
            user: {
                type: Object,
                required: false,
                default: () => ({}), // Garante que o usuário seja um objeto vazio por padrão
            }
        },
        data() {
            return {
                comments: [],
                createComment: false,
                comment_id: null,
                contest: '',
                expandedComments: [],
            }
        },
        methods: {
            getComments(){
                axios.get(route('api.posts.comments', { post: this.post_id }))
                    .then(response => {
                        this.comments = response.data.data;
                    })
                    .catch(error => {
                        console.error('Error fetching comments:', error);
                    });  
            },
            selectComment(comment, isEdit = false){
                this.createComment = !this.createComment;
                this.comment_id = isEdit ? comment.comment_id : comment.id;
                this.contest = isEdit ? comment.description : '';
            },
            deleteComment(comment){
                this.comment_id = comment.id;
            },
            showComment(commentId) {
                const index = this.expandedComments.indexOf(commentId);
                if (index === -1) {
                    this.expandedComments.push(commentId);
                } else {
                    this.expandedComments.splice(index, 1);
                }
            },
            link(comment) {
                axios.post(route('api.links.store', {comment_id: comment.id}))
                    .then(response => {
                        const index = this.comments.indexOf(comment);
                        if (index !== -1) {
                            this.comments[index].countLinks = response.data.countComment;
                        }
                    })
                    .catch(error => {
                        if (error.response?.status === 401) {
                            window.location.href = route('login') + '?intended=' + encodeURIComponent(window.location.href);
                        } else {
                            console.error('Error response data:', error.response?.data);
                        }
                    });  
            },
            deslink(comment) {
                axios.post(route('api.deslinks.store', {comment_id: comment.id}))
                    .then(response => {
                        const index = this.comments.indexOf(comment);
                        if (index !== -1) {
                            this.comments[index].countDesLinks = response.data.countComment;
                        }
                    })
                    .catch(error => {
                        if (error.response?.status === 401) {
                            window.location.href = route('login') + '?intended=' + encodeURIComponent(window.location.href);
                        } else {
                            console.error('Error response data:', error.response?.data);
                        }
                    });  
            }
        },
        mounted() {
            this.getComments()
        }
    }
</script>
