<template>
    <a :href="route" class="nav-link">
        {{ name }}
    </a>
    <ul v-if="name != 'Home'" class="dropdown-menu scroll-dropdown">
        <li v-for="(type, index) in types" :key="type.id">
            <a :href="type.route">{{ type.name }}</a>
        </li>
    </ul>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                required: true,
            },
            route: {
                type: String,
                required: true,
            },
            types: {
                type: Array,
                required: false,
            }
        },
        data(){
            return {
                //
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

<style scoped>
    .scroll-dropdown {
        max-height: 300px;
        overflow-y: auto;
    }
</style>