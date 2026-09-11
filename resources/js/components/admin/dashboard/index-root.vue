<template>
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <admin-card-info 
                :name="'Novas Assinaturas'"
                :value="valueSubscription"
                :description="percentageIncrease + '% Último mês'"
                :color="'shadow-primary bg-gradient-primary'"
                :icon="'ni ni-money-coins'"
                :trend="trend"
            ></admin-card-info>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <admin-card-info 
                :name="'Novos Usuários'"
                :value="countUsers"
                :description="percentageIncreaseUsers + '% Último mês'"
                :color="'shadow-danger bg-gradient-danger'"
                :icon="'ni ni-world'"
                :trend="trendUsers"
            ></admin-card-info>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <admin-card-info 
                :name="'Novos Clientes'"
                :value="countClients"
                :description="percentageIncreaseClients + '% Último mês'"
                :color="'bg-gradient-success shadow-success'"
                :icon="'ni ni-paper-diploma'"
                :trend="trendClients"
            ></admin-card-info>
        </div>
        <div class="col-xl-3 col-sm-6">
            <admin-card-info 
                :name="'Novos Posts'"
                :value="countPosts"
                :description="percentageIncreasePosts + '% Último mês'"
                :color="'bg-gradient-warning shadow-warning'"
                :icon="'ni ni-bell-55'"
                :trend="trendPosts"
            ></admin-card-info>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                countSubscription: 0,
                oldSubscription: 0,
                percentageIncrease: 0,
                valueSubscription: 0,
                trend: 'neutral',
                countUsers: 0,
                oldUsers: 0,
                percentageIncreaseUsers: 0,
                trendUsers: 'neutral',
                countClients: 0,
                oldClients: 0,
                percentageIncreaseClients: 0,
                trendClients: 'neutral',
                countPosts: 0,
                percentageIncreasePosts: 0,
                trendPosts: 0
            }
        },
        methods: {
            newSubscription() {
                axios.get(route('api.admin.dashboard.new-subscription'))
                    .then((response) => {
                        this.countSubscription = response.data.newSubscription;
                        this.oldSubscription = response.data.oldSubscription;
                        this.percentageIncrease = response.data.percentageIncrease;
                        this.valueSubscription = response.data.valueSubscription;
                        this.trend = response.data.trend;
                    })
                    .catch((error) => {
                        console.error('Error fetching new subscription:', error);
                    });
            },
            newUsers() {
                axios.get(route('api.admin.dashboard.new-users'))
                    .then((response) => {
                        this.countUsers = response.data.newUsers;
                        this.oldUsers = response.data.oldUsers;
                        this.percentageIncreaseUsers = response.data.percentageIncrease;
                        this.trendUsers = response.data.trendUsers;
                    })
                    .catch((error) => {
                        console.error('Error fetching new users:', error);
                    });
            },
            newClients() {
                axios.get(route('api.admin.dashboard.new-clients'))
                    .then((response) => {
                        this.countClients = response.data.newClients;
                        this.oldClients = response.data.oldClients;
                        this.percentageIncreaseClients = response.data.percentageIncrease;
                        this.trendClients = response.data.trend;
                    })
                    .catch((error) => {
                        console.error('Error fetching new clients:', error);
                    });
            },
            newPosts(){
                axios.get(route('api.admin.dashboard.new-posts'))
                    .then((response) => {
                        this.countPosts = response.data.newPosts;
                        this.percentageIncreasePosts = response.data.percentageIncrease;
                        this.trendPosts = response.data.trend;
                    })
                    .catch((error) => {
                        console.error('Error fetching new clients:', error);
                    });
            }
        },
        mounted() {
            this.newSubscription();
            this.newUsers();
            this.newClients();
            this.newPosts();
        }
    }
</script>