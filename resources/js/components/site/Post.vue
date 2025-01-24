<template>
    <div class="row">
        <div class="col-md-3">
            <div class="product-item">
                <figure class="product-style">
                    <img src="images/tab-item1.jpg" alt="Books" class="product-item">
                    <button type="button" class="add-to-cart" data-product-tile="comment" @click="showPost('teste')">Comentar</button>
                </figure>
                <figure>
                    <figcaption>
                        <h3>Portrait photography</h3>
                    </figcaption>
                </figure>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            
        }
    },
    methods: {
        showPost(id){
            let url = route('posts.show', id)
            window.location.href = url;
        }
    }
}
</script>
