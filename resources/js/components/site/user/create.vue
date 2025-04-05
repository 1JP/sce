<template>
    <component-card
        :class-card="'mb-2'"
        :card-body="true"
        style="background: #EDEBE4;"
    >
        <template v-slot:body>
            <slot/>
        </template>
    </component-card>
</template>
  
<script>
  export default {
    props: {
      
    },
    data() {
        return {};
    },
    methods: {}
  }
</script>
  