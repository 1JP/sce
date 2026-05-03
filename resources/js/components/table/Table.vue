<template>
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <slot name="thead"/>
            </thead>
            <tbody>
                <slot name="tbody"/>
            </tbody>
        </table>

        <component-paginate v-if="pagination" :pagination="pagination" @page-change="changePage()"/>
        
    </div>
</template>

<script>
export default {
    props: {
        pagination: {
            type: Object,
            default: null,
        },
    },

    emits: ['page-change'],

    computed: {
        visiblePages() {
            const { current_page, last_page } = this.pagination
            const pages = []
            const delta = 2

            for (let i = 1; i <= last_page; i++) {
                if (
                    i === 1 ||
                    i === last_page ||
                    (i >= current_page - delta && i <= current_page + delta)
                ) {
                    pages.push(i)
                } else if (pages[pages.length - 1] !== '...') {
                    pages.push('...')
                }
            }

            return pages
        },
    },

    methods: {
        changePage(page) {
            if (page < 1 || page > this.pagination.last_page) return
            this.$emit('page-change', page)
        },
    },
}
</script>