<template>
    <div class="container">
        <div class="row d-flex flex-row justify-content-center align-items-center border-bottom border-top py-2 pt-4">
            <div style="" class="col-2 col-lg-2">
                <div class="d-block p-2" style="height: 40px;"></div>
            </div>
            <div style="" class="col-lg-10 text-right col-10">
                <p>Relatório emitido em {{ emittedAt }} em www.sce.com.br - copyright © {{ currentYear }}</p>
            </div>
        </div>
    </div> 
</template>

<script>
    export default {
        data() {
            const now = new Date();

            return {
                emittedAt: new Intl.DateTimeFormat('pt-BR', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                }).format(now).replace(', ', ' às '),
                currentYear: now.getFullYear()
            }
        }
    }
</script>
