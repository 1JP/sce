<template>
    <a href="#pages" class="nav-link">
        {{ name }}
    </a>
    <ul v-if="name != 'Home'">
        <li class="active">
            <a href="index.html">Home</a>
        </li>
        <li><a href="index.html">About</a></li>
        <li><a href="index.html">Styles</a></li>
        <li><a href="index.html">Blog</a></li>
        <li><a href="index.html">Post Single</a></li>
        <li><a href="index.html">Our Store</a></li>
        <li><a href="index.html">Product Single</a></li>
        <li><a href="index.html">Contact</a></li>
        <li><a href="index.html">Thank You</a></li>
    </ul>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                required: true,
            },
        },
        data(){
            return {
                
            }
        }
    }
</script>