<template>
    <div :class="['dropdown', classItem]">
        <button :class="classButton" data-bs-toggle="dropdown" :id="name">
            <i :class="icon"></i> <span class="text-white" v-if="span != ''">{{ span }}</span>
        </button>
        <ul class="dropdown-menu" :aria-labelledby="name">
            <slot/>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                required: true,
            },
            icon: {
                type: String,
                default: 'fa fa-ellipsis-v text-xs'
            },
            classItem: {
                type: String,
                default: ''
            },
            classButton: {
                type: String,
                default: 'btn btn-link text-secondary mb-0'
            },
            span: {
                type: String,
                default: ''
            },
        },
    }
</script>
