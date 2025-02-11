<template>
    <div class="form-group">
        <select class="form-control" v-model="normalizedSelectedValues" @change="optionsSelected($event)">
            <option v-if="name != ''" :value="''">{{ name }}</option>
            <option v-for="option,index in options" :key="index" :value="option.id ?? option">
                {{ option.name ?? option }}
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        emits: ['onChanged', 'update:valueSelect'],
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
                type: [String, Number, Array],
            }
        },
        methods: {
            optionsSelected(value){
                this.$emit('onChanged', value)
            }
        },
        computed: {
            normalizedSelectedValues: {
                get() {
                    if (Array.isArray(this.valueSelect)) {
                        return this.valueSelect;
                    }
                    if (typeof this.valueSelect === "string") {
                        return this.valueSelect.split(",").map(val => Number(val.trim()));
                    }
                    if (typeof this.valueSelect === "number") {
                        return [this.valueSelect]; // Converte número em array
                    }
                    return [];
                },
                set(newValue) {
                    this.$emit("update:valueSelect", newValue);
                }
            }
        },
    }
</script>
