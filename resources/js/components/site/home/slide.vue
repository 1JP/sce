<template>
    <section id="billboard">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <button class="prev slick-arrow">
                        <i class="icon icon-arrow-left"></i>
                    </button>
                    <div class="main-slider pattern-overlay">
                        <div 
                            v-for="post in allPosts" 
                            :key="post.id"
                            class="slider-item"
                        >
                            <div class="banner-content">
                                <h2 class="banner-title">{{ post.name }}</h2>
                                <p>{{ post.description }}</p>
                                <div class="btn-wrap">
                                    <a :href="route('posts.show', post.id)" class="btn btn-outline-accent btn-accent-arrow">
                                        Comentar
                                        <i class="icon icon-ns-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <img :src="post.images[0].image" :alt="post.images[0].name" class="slider-img">
                        </div>
                    </div>
                    <button class="next slick-arrow">
                        <i class="icon icon-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>   
</template>

<script>
    export default {
        components: {
            //
        },
        props: {
            //
        },
        data() {
            return {
                allPosts: []
            }
        },
        methods: {
            listPosts(){
                axios.get(route('api.posts.top'))
                    .then((response) => {
                        this.allPosts = response.data.data;
                        this.$nextTick(() => {
                            this.initSlider();
                        });
                    })
            },
            initSlider() {
                if (window.jQuery && window.jQuery.fn.slick) {
                    const $slider = window.jQuery('.main-slider');
                    if ($slider.hasClass('slick-initialized')) {
                        $slider.slick('unslick');
                    }
                    $slider.slick({
                        autoplay: false,
                        autoplaySpeed: 4000,
                        fade: true,
                        dots: true,
                        prevArrow: window.jQuery('.prev'),
                        nextArrow: window.jQuery('.next'),
                    });
                }
            }
        },
        mounted() {
            this.listPosts()
        },
        beforeUnmount() {
            if (window.jQuery && window.jQuery('.main-slider').hasClass('slick-initialized')) {
                window.jQuery('.main-slider').slick('unslick');
            }
        }
    }
</script>