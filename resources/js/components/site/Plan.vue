<template>
    <div class="row">
        <div class="col-lg-3 p-3" v-for="plan in allPlans" :key="plan.id">
            <form :action="route('pagamento.create')" method="GET">
                <input type="hidden" name="plan_id" :value="plan.id">
                <div class="card text-center bg-primary text-light">
                    <div class="card-body p-4">
                        <h3>{{ plan.name }}</h3>
                        <h2 class="my-3">
                            <b>R$ {{ plan.value }}</b> 
                            <sub><span style="font-weight: normal;">/mensais</span></sub>
                        </h2>
                        <hr>
                        <p>{{ plan.description }}</p>
                        <button type="submit" class="btn mt-3 btn-dark btn-block rounded">Contratar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        components: {
            //
        },
        props: {
            //
        },
        data() {
            return {
                allPlans: []
            }
        },
        methods: {
            getPlans() {
                axios.get(route('api.plans.all'))
                    .then((response) => {
                        this.allPlans = response.data.data;
                    })
            }
        },
        mounted() {
            this.getPlans();
        }
    }
</script>
