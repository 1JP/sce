<template>
    <div class="form-group">
        <select class="form-control">
            <option>{{ name }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            options: {
                type: Array,
                required: true,
                default: () => [],
            },
            name: {
                type: String,
                required: true,
            }
        },
    }
</script>
