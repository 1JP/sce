<template>
    <div class="col-lg-9">
        <site-create-user 
            :email="email" 
            :route-form="routeForm"
            :is-update="true"
        />
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            email: {
                type: String,
                required: false,
            },
            routeForm: {
                type: String,
                required: false,
            },
        },
        data() {
            return {
                token: ''

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