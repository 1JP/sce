<template>
    <section id="popular-books" class="bookshelf ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header align-center">
                        <h2 class="section-title">Popular</h2>
                    </div>

                    <ul class="tabs">
                        <li data-tab-target="#all-genre" class="active tab">All Genre</li>
                        <li v-for="category in categories" :key="category" 
                            class="tab"
                            :data-tab-target="'#' + category.name"
                        >
                            {{ category.name }}
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="all-genre" data-tab-content class="active">
                            <site-post :posts="allPosts"></site-post>
                        </div>
                        <div v-for="category in categories" :key="category" 
                            :id="category.name" 
                            data-tab-content
                        >
                            <site-post :posts="allPosts.filter(post => post.category_id === category.id)"></site-post>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import { all } from 'axios';

    export default {
        components: {
            //
        },
        props: {
            //
        },
        data() {
            return {
                allPosts: [],
                categories: [],
            }
        },
        methods: {
            getAllPosts() {
                axios.get(route('api.posts.all'))
                    .then(response => {
                        this.allPosts = response.data.data;
                    })
                    .catch(error => {
                        console.error('Error fetching posts:', error);
                    });
            },
            getCategories() {
                axios.get(route('api.categories.index'))
                    .then(response => {
                        this.categories = response.data.data;
                    })
                    .catch(error => {
                        console.error('Error fetching categories:', error);
                    });
            },
        },
        mounted() {
            this.getAllPosts();
            this.getCategories();
        }
    }
</script>