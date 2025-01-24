<template>
    <nav id="navbar">
        <div class="main-menu stellarnav">
            <ul class="menu-list">
                <li class="menu-item active">
                    <site-nav
                        :name="'Home'"
                    ></site-nav>
                </li>
                <li class="menu-item has-sub">
                    <site-nav
                        :name="'Livros'"
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
                
            }
        }
    }
</script>