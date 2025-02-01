<template>
    <th :class="class">
        <slot/>
    </th>
</template>

<script>
    export default {
        props: {
            class: {
                type: String,
                required: false,
                default: ''
            },
        },
        mounted() {
            //
        }
    }
</script>
