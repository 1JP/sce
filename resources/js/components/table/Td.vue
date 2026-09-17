<template>
    <td :class="class">
        <slot/>
    </td>
</template>

<script>
    export default {
        props: {
            class: {
                type: String,
                required: false,
            },
        },
    }
</script>
