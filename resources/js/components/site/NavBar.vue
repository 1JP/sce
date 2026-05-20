<template>
    <nav id="navbar">
        <div class="main-menu stellarnav">
            <ul class="menu-list">
                <li class="menu-item active">
                    <site-nav
                        :route="routeHome"
                        :name="'Home'"
                    ></site-nav>
                </li>
                <li class="menu-item has-sub" v-for="category in categories" :key="category.id">
                    <site-nav
                        :route="category.route"
                        :name="category.name"
                        :types="category.types"
                    ></site-nav>
                </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        data(){
            return {
                routeHome: route('home'),
                categories: [],
            }
        },
        methods: {
            listCategories(){
                axios.get(route('api.categories.index'))
                    .then((response) => {
                        this.categories = response.data.data.map(category => ({
                            id: category.id, 
                            name: category.name,
                            route: route('categorias.show', category.id),
                            types: category.category_types
                                .sort((a, b) => a.name.localeCompare(b.name))
                                .map(type => ({
                                    id: type.id,
                                    name: type.name,
                                    route: '#'
                                }))
                        }));
                    })
            },
        },
        mounted(){
            this.listCategories();
        }
    }
</script>