<template>
    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
        <div class="d-flex align-items-center">
            <div class="d-flex flex-column">
                <h6 class="mb-1 text-dark text-sm">{{ name }}</h6>
                <span class="text-xs">{{ number }} posts</span>
            </div>
        </div>
        <div class="d-flex">
            <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                <i class="ni ni-bold-right" aria-hidden="true"></i>
            </button>
        </div>
    </li>
</template>

<script>
    export default {
        props: {
            route: {
                type: String,
                required: true,
            },
            name: {
                type: String,
                required: true,
            },
            number: {
                type: String,
                required: true,
            }
        },
    }
</script>
