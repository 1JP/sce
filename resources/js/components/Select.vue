<template>
    <select :class="['form-control', classItem]" v-model="normalizedSelectedValues" :name="nameId" :id="id" :required="isRequired" :multiple="isMutiple">
        <option v-if="placeholder != ''" :value="''">{{ placeholder }}</option>
        <option v-for="option,index in options" :key="index" :value="option.id ?? option">
            {{ option.name ?? option }}
        </option>
    </select>
</template>

<script>
    export default {
        emits: ['update:valueSelect'],
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
                type: [String, Number, Array],
            }
        },
        methods: {
            //
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
                        return this.valueSelect; // Converte número em array
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
