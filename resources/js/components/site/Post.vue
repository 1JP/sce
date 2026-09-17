<template>
    <div class="row">
        <div class="col-md-3" v-for="post in posts" :key="post.id">
            <div class="product-item">
                <figure class="product-style">
                    <img :src="post.images[0].image" 
                        :alt="post.name" 
                        :class="['product-item', post.images[0].name === 'Default' ? 'product-item--default' : '']"
                    >
                    <button type="button" class="add-to-cart" data-product-tile="comment" @click="showPost(post.id)">Comentar</button>
                </figure>
                <figure>
                    <figcaption>
                        <h3>{{ post.name }}</h3>
                    </figcaption>
                </figure>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        posts: {
            type: Array,
            default: []
        }
    },
    data(){
        return {
            //
        }
    },
    methods: {
        showPost(id){
            let url = route('posts.show', id)
            window.location.href = url;
        }
    },
    mounted() {
        //
    }
}
</script>
