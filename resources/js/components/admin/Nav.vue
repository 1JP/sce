<template>
    <a class="nav-link" :href="route">
        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i :class="icon" class="text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">{{ name }}</span>
    </a>
</template>

<script>
    export default {
        props: {
            route: {
                type: String,
                required: true,
            }, 
            icon: {
                type: String,
                required: true,
            },
            name: {
                type: String,
                required: true,
            },
            view: {
                type: Boolean,
                required: false,
            }
        },
    }
</script>
