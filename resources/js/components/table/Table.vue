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

        <div v-if="pagination" class="d-flex align-items-center justify-content-between px-3 py-2 border-top flex-wrap gap-2">
            <small class="text-muted">
                Mostrando {{ pagination.from ?? 0 }}–{{ pagination.to ?? 0 }} de {{ pagination.total }} resultados
            </small>

            <nav v-if="pagination.last_page > 1">
                <ul class="pagination pagination-sm mb-0 flex-wrap">
                    <li class="page-item" :class="{ disabled: !pagination.prev_page_url }">
                        <button class="page-link" @click="changePage(pagination.current_page - 1)">
                            &lsaquo;
                        </button>
                    </li>

                    <li
                        v-for="page in visiblePages"
                        :key="page"
                        class="page-item"
                        :class="{ active: page === pagination.current_page, disabled: page === '...' }"
                    >
                        <button class="page-link" @click="page !== '...' && changePage(page)">
                            {{ page }}
                        </button>
                    </li>

                    <li class="page-item" :class="{ disabled: !pagination.next_page_url }">
                        <button class="page-link" @click="changePage(pagination.current_page + 1)">
                            &rsaquo;
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    
</template>

<script>
    export default {
        props: {
            pagination: {
                type: Object,
                default: null
            }
        },
        computed: {
            visiblePages() {
                if (!this.pagination) return [];

                const totalPages = this.pagination.last_page;
                const currentPage = this.pagination.current_page;
                const pages = [];

                if (totalPages <= 7) {
                    for (let i = 1; i <= totalPages; i++) {
                        pages.push(i);
                    }
                } else {
                    pages.push(1);
                    if (currentPage > 4) pages.push('...');
                    
                    const startPage = Math.max(2, currentPage - 2);
                    const endPage = Math.min(totalPages - 1, currentPage + 2);

                    for (let i = startPage; i <= endPage; i++) {
                        pages.push(i);
                    }

                    if (currentPage < totalPages - 3) pages.push('...');
                    pages.push(totalPages);
                }

                return pages;
            }
        },
        methods: {
            changePage(page) {
                if (page >= 1 && page <= this.pagination.last_page) {
                    this.$emit('page-changed', page);
                }
            }
        }

    }
</script>
