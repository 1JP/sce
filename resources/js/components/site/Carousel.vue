<template>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button"v-for="image in images" :key="image.name" :class="{ active: images.indexOf(image) === 0 }" :data-bs-target="'#carouselExampleIndicators'" :data-bs-slide-to="images.indexOf(image)" :aria-label="'Slide ' + (images.indexOf(image) + 1)"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item" v-for="image in images" :key="image.name" :class="{ active: images.indexOf(image) === 0 }">
                <img :src="image.image" class="d-block w-100" :alt="image.name">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            images: {
                type: Array,
                required: false
            }
        },
        data() {
            return {
                //
            }
        },
        methods: {
            //
        }
    }
</script>