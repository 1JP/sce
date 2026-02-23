<template>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-3" style="">
            <list-group :class-item="'list-group-flush mb-5'">
                <list-group-item v-for="menu in menus.filter(menu => menu.view)" 
                    :class-item="[menu.selected ? 'active' : 'list-group-item-action']"
                    :style="[menu.selected ? '' : 'background: #EDEBE4']"
                >
                    <a :href="menu.route"
                        v-if="!menu.modal"
                        @click="statusMenus(menu.label)"
                    >
                        {{ menu.label }}
                    </a>
                    <a :href="menu.route"
                        v-else
                        data-bs-toggle="modal" :data-bs-target="menu.name"
                        @click="statusMenus(menu.label)"
                    >
                        {{ menu.label }}
                    </a>
                </list-group-item>
                <list-group-item :class-item="'list-group-item-action'" style="background: #EDEBE4;">
                    <a :href="routeLogout">
                        Sair
                    </a>
                </list-group-item>
            </list-group>
        </div>
        <site-my-account
            :email="user.email" 
            :route-form="route('usuarios.update', user.id)"
        />
    </div>

    <model :title="'Deseja ser um cliente?'" :name="'new-client'">
        Deseja ser um cliente para o público comentar sobre o seu livro, filme, série, anime até mesmo seu mangá?
        So clicar <b>Sim</b>
        <template v-slot:footer>
            <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</a>
            <a :href="route('pagamento.create')" class="btn btn-primary">Sim</a>
        </template>
    </model>
</template>

<script>

    export default {
        props: {
            isRole: {
                type: Boolean,
                required: false,
                default: false
            },
            user: {
                type: Object,
                default: () => []
            }
        },
        data() {
            return {
                routeLogout: route('auth.logout'),
                menus: [
                    {
                        'label': 'Minha conta',
                        'view': true,
                        'selected': true,
                        'route': '#',
                        'modal': false,
                        'name': ''
                    },
                    {
                        'label': 'Área administrativa',
                        'view': !this.isRole,
                        'selected': false,
                        'route': route('admin.dashboard'),
                        'modal': false,
                        'name': ''
                    },
                    {
                        'label': 'Seja ser um cliente?',
                        'view': this.isRole,
                        'selected': false,
                        'route': '#',
                        'modal': true,
                        'name': '#new-client'
                    },
                ],
                token: ''
            };
        },
        methods: {
            statusMenus(label){
                this.menus.forEach(menu => {
                    menu.selected = false
                    menu.selected = menu.label === label
                });
            }
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>