<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-white" href="javascript:;">
                    <i class="fa fa-fw fa-home mr-2"></i>
                </a>
            </li>
            <li v-for="(item, index) in items" :key="index" class="breadcrumb-item text-sm text-white active">
                <a v-if="item.route" :href="item.route" class="opacity-5 text-white">
                    {{ item.name }}
                </a>
                <span v-else>
                    {{ item.name }}
                </span>
            </li>
        </ol>
    </nav>
</template>

<script>
    export default {
        props: {
            items: {
                type: Array,
                required: true,
                default: () => [],
            }
        },

    }
</script>
