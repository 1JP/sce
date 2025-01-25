<template>
    <input :class="['form-control', classInput]" :value="value" @blur="handleBlur($event)" @input="handleInput($event)" :required="required" :type="inputType" :placeholder="placeholder" :name="nameId" :maxlength="maxLength" :disabled="isDisabled">
</template>

<script>
    export default {
        emits: ['input', 'blur'],
        props: {
            showLabel: {
                required: false,
                type: Boolean,
                default: true
            },
            iconInput: {
                required: false,
                type: String,
                default: ''
            },
            nameId: {
                required: false,
                type: String,
                default: ''
            },
            placeholder: {
                required: false,
                type: String,
                default: ''
            },
            instruction: {
                required: false,
                type: String,
                default: ''
            },
            widths: {
                required: false,
                default: '100%',
                type: String
            },
            mode: {
                required: false,
                type: String,
                default: 'none'
            },
            inputType: {
                required: false,
                type: String,
                default: 'text'
            },
            value: {
                default: ''
            },
            maxLength: {
                required: false,
                default: ''
            },
            isDisabled: {
                required: false,
                default: false
            },
            required: {
                required: false,
                default: false
            },
            classInput: {
                required: false,
                default: ''
            }
        },
        data () {
            return {
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
