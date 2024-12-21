<template>
    <div class="dropdown">
        <button class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" :id="name">
            <i class="fa fa-ellipsis-v text-xs"></i>
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
        },
    }
</script>
