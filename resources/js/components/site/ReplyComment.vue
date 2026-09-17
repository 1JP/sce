<template>
    <div>
        <ChildrenComment :children="comments" />
    </div>
</template>
  
<script>
    import ChildrenComment from './ChildrenComment.vue';
    
    export default {
        components: {
            ChildrenComment,
        },
        data() {
            return {
                comments: [],
            };
        },
    };
</script>
  