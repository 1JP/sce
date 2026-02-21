<template>
    <div class="col-lg-9">
        
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            
        },
        data() {
            return {
                //
            };
        },
        methods: {
            //
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>