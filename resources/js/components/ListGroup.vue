<template>
    <ul :class="['list-group', classItem]">
        <slot/>
    </ul>
</template>

<script>
    export default {
        props: {
            classItem: {
                type: String,
                required: false,
            },
        }
    }
</script>
