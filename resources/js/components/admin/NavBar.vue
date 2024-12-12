<template>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
        <div class="sidenav-header">
            <i class="fa fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
                <span class="ms-1 font-weight-bold">Argon Dashboard 2</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item" v-for="nav, index in navs" :key="index">
                    <admin-nav
                        :route="nav.route"
                        :icon="nav.icon"
                        :name="nav.name"
                    />
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                </li>
                <li class="nav-item" v-for="account, index in accounts" :key="index">
                    <admin-nav
                        :route="account.route"
                        :icon="account.icon"
                        :name="account.name"
                    />
                </li>
            </ul>
        </div>
    </aside>
</template>

<script>
    export default {
        data(){
            return {
                navs: [
                    {route: '#', icon: 'ni ni-tv-2', name: 'Dashboard', view: true },
                    {route: '#', icon: 'ni ni-archive-2', name: 'Categorias', view: true },
                    {route: '#', icon: 'ni ni-archive-2', name: 'Tipos de Categorias', view: true },
                    {route: '#', icon: 'ni ni-bullet-list-67', name: 'Posts', view: true },
                    {route: '#', icon: 'ni ni-istanbul', name: 'Classificação Indicativas', view: true },
                    {route: '#', icon: 'ni ni-credit-card', name: 'Assinatura', view: true },
                    {route: '#', icon: 'ni ni-user-run', name: 'Clientes', view: true },
                    {route: '#', icon: 'ni ni-badge', name: 'Membros', view: true },
                    {route: '#', icon: 'ni ni-folder-17', name: 'Logs', view: true },
                    {route: '#', icon: 'ni ni-settings-gear-65', name: 'Permissões', view: true },
                ],
                accounts: [
                    {route: '#', icon: 'ni ni-single-02', name: 'Profile', view: true },
                ]
            }
        }
    }
</script>
