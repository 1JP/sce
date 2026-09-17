<template>
    <input :class="['form-control', classInput]" 
        :value="value" 
        @blur="handleBlur($event)" 
        @input="handleInput($event)" 
        :required="required" 
        :type="inputType" 
        :placeholder="placeholder" 
        :name="nameId"
        :checked="checked" 
        :maxlength="maxLength"
        :max="max"
        :min="min" 
        :disabled="isDisabled"
    >
    <slot/>
</template>

<script>
    export default {
        emits: ['input', 'blur'],
        props: {
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
            max: {
                required: false,
                default: ''
            },
            min: {
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
            },
            checked: {
                required: false,
                default: false
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
