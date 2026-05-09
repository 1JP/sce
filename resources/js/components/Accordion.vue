<template>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <component-accordion-item 
            v-for="item, index in itens" :key="index" 
            :id-item="index" 
            :name="item.name ?? item"
            :itens="item.itens"
            @onChanged="$emit('onChanged', $event)"
        />
    </div>
</template>

<script>
    export default {
        props: {
            itens: {
                type: Array,
                required: true,
            },
        },
        data(){
            return {
                //
            }
        },
        methods: {
            //
        },
        mounted() {
            //
        }
    }
</script>
