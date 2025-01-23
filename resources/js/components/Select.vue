<template>
    <select class="form-control" :id="id" :required="isRequired">
        <option v-for="option,index in options" :key="index">{{ option }}</option>
    </select>
</template>

<script>
    export default {
        emits: ['onChanged'],
        props: {
            options: {
                type: Array,
                default: () => []
            },
            isRequired: {
                type: Boolean,
                default: false
            }

        },
        methods: {
            optionsSelected(value){
                this.select.push(value+';');
                this.$emit('onChanged', this.select)
            }
        },
    }
</script>
