<template>
    <textarea :class="['form-control', classInput]" v-model="normalizedSelectedValues" @blur="handleBlur($event)" @input="handleInput($event)" :required="required" :type="inputType" :placeholder="placeholder" :name="nameId"></textarea>
</template>

<script>
    export default {
        emits: ['input', 'blur', 'update:value'],
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
        computed: {
            normalizedSelectedValues: {
                get() {
                    return this.value;
                },
                set(newValue) {
                    this.$emit("update:value", newValue);
                }
            }
        },
    }
</script>
