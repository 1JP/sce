<template>
    <div class="d-flex flex-column">
        <h6 class="mb-1 text-dark font-weight-bold text-sm">
            {{ date }}
        </h6>
        <span class="text-xs">#AS-{{ id }}</span>
    </div>
    <div class="d-flex align-items-center text-sm">
        R$ {{ value }}
        <a :href="route" class="btn btn-link text-dark text-sm mb-0 px-0 ms-4">
            <i class="fa fa-file-pdf-o text-lg me-1"></i> PDF
        </a>
    </div>
</template>

<script>
    export default {
        props: {
            value: {
                type: String,
                required: true,
            }, 
            id: {
                type: String,
                required: true,
            },
            date: {
                type: String,
                required: true,
            },
            route:{
                type: String,
                required: true,
            },
        },
    }
</script>
