<template>
    <li :class="['list-group-item', classItem]" >
        <slot/>
    </li>
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
