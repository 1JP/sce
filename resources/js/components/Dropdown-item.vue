<template>
    <li>
        <a v-if="route != ''" class="dropdown-item" href="#">
            {{ name }}
        </a>
        <a v-else class="dropdown-item" href="#" data-bs-toggle="modal" :dataBsTarget="target">
            {{ name }}
        </a>
    </li>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                required: true,
            },
            route: {
                type: String,
                required: false,
            },
            target: {
                type: String,
                required: false,
            }
        },
    }
</script>
