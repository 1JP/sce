<template>
    <div class="form-group">
        <select class="form-control">
            <option v-if="name != ''" :value="''">{{ name }}</option>
            <option v-for="option,index in options" :key="index" :value="option.id ?? option" 
                :selected="valueSelect == (option.id ?? option)">
                {{ option.name ?? option }}
            </option>
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
            },
            valueSelect: {
                required: false,
                type: [String, Number],
            }
        },
    }
</script>
