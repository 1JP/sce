<template>
    <div class="form-group input-group">
        <span class="input-group-text text-body" v-if="icon != ''"><i :class="icon"></i></span>
        <span class="input-group-text text-body" v-else>
            <slot/>
        </span>
        <input :type="type" class="form-control" :placeholder="name">
    </div>
</template>

<script>
    export default {
        props: {
            icon: {
                type: String,
                required: false,
                default: '',
            },
            name: {
                type: String,
                required: false,
                default: '',
            },
            type: {
                type: String,
                required: true,
            },
        },

    }
</script>
