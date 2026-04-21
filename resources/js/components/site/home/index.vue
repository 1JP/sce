<template>
    <Slide/>
    <Popolare/>
    <div class="container">
        <div class="row">
            <div class="text-center mx-auto col-md-12">
                <h1 class="section-title">Planos</h1>
            </div>
        </div>
        <site-plan></site-plan>
    </div>
</template>

<script>
    import Slide from './slide.vue';
    import Popolare from './popolare.vue';

    export default {
        components: {
            Slide,
            Popolare
        },
        props: {
            //
        },
        data() {
            return {

            }
        },
        methods: {
            //
        },
        mounted() {
            //
        }
    }
</script>