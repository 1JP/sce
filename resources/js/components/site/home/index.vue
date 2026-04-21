<template>
    <Slide/>
    <Popolare/>
    <div class="container" v-if="!userRoles">
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
            user: {
                type: Object,
                required: false
            }
        },
        data() {
            return {
                userRoles: false
            }
        },
        methods: {
            //
        },
        mounted() {
            if (this.user) {
                this.userRoles = this.user.roles.filter(role => role.name === 'Admin').length > 0 ? 'Admin' : 'User'
            }
        }
    }
</script>