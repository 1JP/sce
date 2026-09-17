<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3" style="background: #EDEBE4;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <site-carousel :images="post.images"></site-carousel>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-8">
                                    <h2 class="card-title p-3">{{ post.name }}</h2>
                                    <p class="card-text m-3">{{ post.description }}</p>
                                    <div class="m-0" v-if="user">
                                        <div class="row m-1 align-items-center">
                                            <div class="col-lg-3">
                                                <component-input
                                                    :required="true"
                                                    :input-type="'number'"
                                                    :name-id="'rating'"
                                                    :value="rating"
                                                    :class-input="classRating"
                                                    :min="0"
                                                    :max="10"
                                                    @input="inputRating($event)"
                                                />
                                            </div>
                                            <div class="col-lg-3">
                                                <button class="btn btn-primary text-light rounded-lg h-25 mt-0 me-0" @click="save()">Votar</button>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="card-text m-3">Nota: {{ localPost.note }}</p>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="hover-actions-trigger top-0 m-3">
                                        <a class="me-2" @click="link(post)">
                                            <i class="bi bi-hand-thumbs-up"></i>
                                            {{ localPost.countLinks }}
                                        </a>
                                        <a class="me-1" @click="deslink(post)">
                                            <i class="bi bi-hand-thumbs-down"></i>
                                            {{ localPost.countDeslikes }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 list-comments">
                                        <site-comment
                                            :post_id="post.id"
                                            :user="user"
                                        ></site-comment>
                                    </div>
                                    <site-create-comment
                                        :post_id="post.id"
                                        :comment_id="null">
                                    </site-create-comment>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object,
                required: false
            },
            user: {
                type: Object,
                required: false
            }
        },
        data() {
            return {
                localPost: { ...this.post },
                rating: 0,
                classRating: ''
            }
        },
        methods: {
            link(post) {
                axios.post(route('api.links.store', {post_id: post.id}))
                    .then(response => {
                        this.localPost.countLinks = response.data.countPost;
                    })
                    .catch(error => {
                        if (error.response?.status === 401) {
                            window.location.href = route('login') + '?intended=' + encodeURIComponent(window.location.href);
                        } else {
                            console.error('Error response data:', error.response?.data);
                        }
                    });  
            },
            deslink(post) {
                axios.post(route('api.deslinks.store', {post_id: post.id}))
                    .then(response => {
                        this.localPost.countDeslikes = response.data.countPost;
                    })
                    .catch(error => {
                        if (error.response?.status === 401) {
                            window.location.href = route('login') + '?intended=' + encodeURIComponent(window.location.href);
                        } else {
                            console.error('Error response data:', error.response?.data);
                        }
                    });  
            },
            inputRating(event) {
                this.rating = event.target.value;
            },
            getRating() {
                if (!this.user) {
                    return;
                }
                
                axios.get(route('api.ratings.get', {user: this.user.id, post: this.post.id}))
                    .then(response => {
                        this.rating = response.data.data.rating;
                    })
                    .catch(error => {
                        console.error('Error response data:', error.response?.data);
                    });
            },
            save() {
                axios.post(route('api.ratings.store', {post_id: this.post.id}), {
                    rating: this.rating
                })
                .then(response => {
                    this.localPost.note = response.data.average_rating;
                    this.rating = response.data.note;
                    this.classRating = 'is-valid';
                })
                .catch(error => {
                    console.error('Error response data:', error.response?.data);
                    this.classRating = 'is-invalid';
                });  
            }
        },
        mounted() {
            this.getRating();
        }
    }  
</script>