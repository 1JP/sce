<template>
    <div class="progress">
        <div :class="['progress-bar', classBar]" 
            role="progressbar" 
            :aria-valuenow="number" 
            aria-valuemin="0" 
            aria-valuemax="100" 
            :style="{ width: number + '%' }"
        ></div>
    </div>
</template>

<script>
    export default {
        props: {
            number: {
                type: Number,
                default: 0
            },
        },
        data(){
            return {}
        },
        methods: {},
        computed: {
            classBar() {
                if (this.number === 0) {
                    return 'bg-gradient-success';
                } else if (this.number > 0 && this.number < 50) {
                    return 'bg-gradient-danger';
                } else if (this.number > 70 && this.number <= 100){
                    return 'bg-gradient-success';
                } else {
                    return 'bg-gradient-info';
                }
            }
        }
    }
</script>