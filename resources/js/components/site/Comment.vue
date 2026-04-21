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
                            <component-dropdown-item name="Editar" @click="selectComment(comment, true)" v-if="user.id == comment.user.id"></component-dropdown-item>
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
                0
            </a>
            <a class="me-1">
                <i class="bi bi-hand-thumbs-down"></i>
                0
            </a>
            <a class="me-2">
                <i class="bi bi-chat-square-text-fill"></i>
                0
            </a>
        </div>
        <site-create-comment v-if="createComment"
            :post_id="post_id"
            :comment_id="comment_id"
            :user="user"
            :comment="contest"
        ></site-create-comment>
        <site-children-comment v-if="comment.children && Array.isArray(comment.children) && comment.children.length > 0" 
            :children="comment.children" :user="user"
        ></site-children-comment>
    </div>
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
                required: false
            }
        },
        data() {
            return {
                comments: [],
                createComment: false,
                comment_id: null,
                contest: '',
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
                this.createComment = true;
                this.comment_id = isEdit ? comment.comment_id : comment.id;
                this.contest = isEdit ? comment.description : '';
            }
        },
        mounted() {
            this.getComments()
        }
    }
</script>
