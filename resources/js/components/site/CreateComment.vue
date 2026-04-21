<template>
    <form method="POST" :action="routeCreate" ref="form">
        <input type="hidden" name="_token" :value="token"/>
        <input type="hidden" name="post_id" :value="post_id"/>
        <input type="hidden" name="comment_id" :value="comment_id"/>
        <div class="row">
            <div class="col-12 col-lg-12">
                <p class="text-dark mt-3 mb-2">Comentar:</p>
                <component-text-area
                    :is-required="true"
                    :placeholder="'Comentar'"
                    :name-id="'description'"
                    :value="description"
                    :class-input="classDescription"
                    @input="valueTextArea($event)"
                />
            </div>
            <div class="col-lg-6 col-6">
                <button class="btn btn-primary text-light rounded-lg btn-lg btn-block mt-3" @click="save()">
                    Comentar <i class="bi bi-chat-square-text-fill"></i> 
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import { comment } from 'postcss';

    export default {
        props: {
            post_id: {
                type: Number,
                required: false
            },
            comment_id: {
                type: Number,
                required: false
            }
        },
        data() {
            return {
                description: '',
                classDescription: '',
                routeCreate: route('comments.store'),
                token: '',
            }
        },
        methods: {
            valueTextArea(event){
                this.description = event.target.value;
            },
            save(){
                if(this.description == ''){
                    this.classDescription = '' ? 'is-invalid' : 'is-valid'
                    return;
                }
                
                this.classDescription = 'is-valid'
                this.$refs.form.submit();
            }
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>
