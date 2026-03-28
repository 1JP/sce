<template>
    <div class="d-flex flex-column">
        <h6 class="mb-1 text-dark font-weight-bold text-sm">
            {{ date }}
        </h6>
        <span class="text-xs">#FA-{{ id }}</span>
    </div>
    <div class="d-flex align-items-center text-sm" :class="classStatus(status)">
       {{ formatStatus(status) }}
    </div>
    <div class="d-flex align-items-center text-sm">
        R$ {{ value }}
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
            status:{
                type: String,
                required: true,
            },
        },
        methods: {
            classStatus(status) {
                switch (status) {
                    case 'DENIED':
                    case 'UNPAID':
                        return 'text-danger'

                    case 'APPROVED':
                        return 'text-success'

                    case 'IN_ANALYSIS':
                    case 'PENDING':
                        return 'text-warning'
                    case 'REFUNDED':
                        return 'text-info'
                    default:
                        return ''
                }
            },
            formatStatus(status) {
                const map = {
                    APPROVED: 'Aprovado',
                    DENIED: 'Negado',
                    PENDING: 'Pendente',
                    IN_ANALYSIS: 'Em análise',
                    REFUNDED: 'Reembolsado',
                    UNPAID: 'Não pago'
                }

                return map[status] || status
            }
        }
    }
</script>
