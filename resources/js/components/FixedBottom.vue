<template>
    <div class="fixed-bottom bg-white shadow-lg border-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex p-3 ml-auto justify-content-end align-items-center flex-row">
                    <a v-if="cancel" class="btn btn-outline-primary m-1" :href="cancel">Cancelar</a>
                    <a v-if="route" class="btn btn-primary m-1" :href="route">
                        {{ name }}
                    </a>
                    <button v-else class="btn btn-primary m-1" :id="name">
                        {{ name }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            route: {
                type: String,
                required: true,
            },
            cancel: {
                type: String,
                required: false,
            },
            name:{
                type: String,
                required: false,
            }
        },
    }
</script>
