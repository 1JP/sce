<template>
    <span class="badge badge-sm" :class="class">
        <slot/>
    </span>
</template>

<script>
    export default {
        props: {
            class: {
                type: String,
                required: true,
            },
        },
    }
</script>
