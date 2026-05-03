<template>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <component-accordion-item v-for="item, index in itens" :key="index" :id-item="index" :name="item"/> 
    </div>
</template>

<script>
    export default {
        data(){
            return {
                itens: ['Categorias', 'Indicativas']
            }
        }
    }
</script>
