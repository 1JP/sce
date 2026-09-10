<template>
    <div class="d-flex align-items-center justify-content-between px-3 py-2 border-top flex-wrap gap-2">
        <small class="text-muted">
            Mostrando {{ pagination.from ?? 0 }}–{{ pagination.to ?? 0 }} de {{ pagination.total }} resultados
        </small>

        <nav v-if="pagination.last_page > 1">
            <ul class="pagination pagination-sm mb-0 flex-nowrap overflow-auto">
                <li class="page-item" :class="{ disabled: pagination.current_page === 1 }">
                    <button class="page-link" @click="changePage(pagination.current_page - 1)">
                        &lsaquo;
                    </button>
                </li>

                <li
                    v-for="page in pagination.links"
                    :key="page"
                    class="page-item"
                    :class="{ active: page === pagination.current_page, disabled: page === '...' }"
                >
                    <button class="page-link" @click="page !== '...' && changePage(page.label)" v-if="isNumber(page.label)">
                        {{ page.label }}
                    </button>
                </li>

                <li class="page-item" :class="{ disabled: pagination.current_page === pagination.last_page }">
                    <button class="page-link" @click="changePage(pagination.current_page + 1)">
                        &rsaquo;
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import { isNumber } from 'chart.js/helpers';

export default {
    props: {
        pagination: {
            type: Object,
            default: null,
        },
    },
    data(){
        return {
            //
        }
    },
    emits: ['page-change'],
    methods: {
        changePage(page) {
            if (page < 1 || page > this.pagination.last_page) return
            this.$emit('page-change', page)
        },
        isNumber(value) {
            let result = isNumber(value);
            return result;
        },
    },
    mounted() {
        //
    }
}
</script>