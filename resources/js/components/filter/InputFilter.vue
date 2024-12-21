<template>
    <div class="form-group input-group">
        <span class="input-group-text text-body" v-if="icon != ''"><i :class="icon"></i></span>
        <input :type="type" class="form-control" :placeholder="name">
    </div>
</template>

<script>
    export default {
        props: {
            icon: {
                type: String,
                required: false,
            },
            name: {
                type: String,
                required: true,
            },
            type: {
                type: String,
                required: true,
            },
        },
    }
</script>
