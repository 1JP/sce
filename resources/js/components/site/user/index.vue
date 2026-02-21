<template>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-3" style="">
            <list-group :class-item="'list-group-flush mb-5'">
                <list-group-item v-for="menu in menus.filter(menu => menu.view)" 
                    :class-item="[menu.selected ? 'active' : 'list-group-item-action']"
                    :style="[menu.selected ? '' : 'background: #EDEBE4']"
                >
                    <a :href="menu.route" 
                        @click="statusMenus(menu.label)">
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
        <div class="col-lg-9">
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

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
                        'route': '#'
                    },
                    {
                        'label': 'Área administrativa',
                        'view': !this.isRole,
                        'selected': false,
                        'route': '#'
                    },
                    {
                        'label': 'Seja ser um cliente?',
                        'view': this.isRole,
                        'selected': false,
                        'route': '#'
                    },
                    {
                        'label': 'Assinatura',
                        'view': true,
                        'selected': this.isRole,
                        'route': '#'
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