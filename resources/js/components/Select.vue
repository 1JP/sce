<template>
    <select :class="['form-control', classItem]" @change="optionsSelected($event)" :name="nameId" :id="id" :required="isRequired" :multiple="isMutiple">
        <option v-if="placeholder != ''" :value="''">{{ placeholder }}</option>
        <option v-for="option,index in options" :key="index" :value="option.id ?? option" 
            :selected="valueSelect == (option.id ?? option)">
            {{ option.name ?? option }}
        </option>
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
            classItem: {
                required: false,
                default: ''
            },
            isRequired: {
                type: Boolean,
                default: false
            },
            isMutiple: {
                type: Boolean,
                default: false
            },
            placeholder: {
                required: false,
                type: String,
                default: ''
            },
            id: {
                required: false,
                type: String,
                default: ''
            },
            nameId: {
                required: true,
                type: String,
            },
            valueSelect: {
                required: false,
                type: [String, Number],
            }
        },
        methods: {
            optionsSelected(value){
                this.$emit('onChanged', value)
            }
        },
    }
</script>
