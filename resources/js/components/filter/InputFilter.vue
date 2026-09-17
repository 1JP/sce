<template>
    <div class="form-group input-group">
        <span class="input-group-text text-body" v-if="icon != ''"><i :class="icon"></i></span>
        <span class="input-group-text text-body" v-else>
            <slot/>
        </span>
        <input :type="type" class="form-control" :placeholder="name" :value="valueInput" @blur="handleBlur($event)" @input="handleInput($event)">
    </div>
</template>

<script>
    export default {
        emits: ['input', 'blur', 'update:valueInput'],
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
            valueInput: {
                required: false,
                type: [String, Number],
            }
        },
        methods: {
            handleInput (e) {
                this.$emit('input', e)
            },
            handleBlur (e) {
                this.$emit('blur', e)
            }
        },
    }
</script>
