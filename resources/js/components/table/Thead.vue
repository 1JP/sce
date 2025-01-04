<template>
    <th :class="class">{{ name }}</th>
</template>

<script>
    export default {
        props: {
            class: {
                type: String,
                required: true,
            },
            name: {
                type: String,
                required: true,
            }
        },
    }
</script>
