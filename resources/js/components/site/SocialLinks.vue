<template>
<div :class="['social-links', classItem]">
    <ul>
        <li v-for="link, index in links" :key="index">
            <a :href="link.route"><i :class="link.icon"></i></a>
        </li>
    </ul>
</div>
</template>

<script>
    export default {
        props: {
            links: {
                type: Array,
                required: true,
                default: () => [],
            },
            classItem: {
                type: String,
                default: ''
            }
        },
    }
</script>