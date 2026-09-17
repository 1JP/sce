<template>
    <component-card
        :class-card="'mb-4'"
        :card-header="true"
        :class-header="'pb-0'"
        :card-body="true"
        :class-body="'px-0 pt-0 pb-2'"
    >
        <template v-slot:header>
            <div class="row">
                <div class="col-lg-4">
                    <h6>Log</h6>
                </div>
                <div class="col-lg-8  d-flex justify-content-end">
                    <a :href="route('admin.logs.index')" class="btn bg-gradient-primary">
                        Voltar
                    </a>
                </div>
            </div>
        </template>
        <template v-slot:body>
            <div class="row m-2" v-if="log.properties?.attributes">
                <p class="col-md-12">
                    <admin-table>
                        <template v-slot:tbody>
                            <admin-tr v-for="(value, key) in log.properties.attributes" :key="key">
                                <component-td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ key }}</h6>
                                        </div>
                                    </div>
                                </component-td>
                                <component-td>
                                    <span v-if="hasChanged(key)" class="text-danger text-decoration-line-through me-2">
                                        {{ formatValue(log.properties.old?.[key]) }}
                                    </span>
                                    <span :class="hasChanged(key) ? 'text-success' : ''">
                                        {{ formatValue(value) }}
                                    </span>
                                </component-td>
                            </admin-tr>
                        </template>
                    </admin-table>
                </p>
            </div>
            <div class="row m-2" v-else-if="log.properties?.old && ! log.properties?.attributes">
                <p class="col-md-12">
                    <admin-table>
                        <template v-slot:tbody>
                            <admin-tr v-for="(value, key) in log.properties.old" :key="key">
                                <component-td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ key }}</h6>
                                        </div>
                                    </div>
                                </component-td>
                                <component-td>
                                    <span v-if="hasChanged(key)" class="text-danger text-decoration-line-through me-2">
                                        {{ formatValue(log.properties.old?.[key]) }}
                                    </span>
                                    <span :class="hasChanged(key) ? 'text-success' : ''">
                                        {{ formatValue(value) }}
                                    </span>
                                </component-td>
                            </admin-tr>
                        </template>
                    </admin-table>
                </p>
            </div>
            <p v-else class="text-muted m-2">Sem propriedades</p>
            <hr class="horizontal dark">
            <div class="row m-2">
                <p class="col-md-2">
                    <span class="badge badge-sm" :class="classStatus(this.log.description)">
                        {{ this.log.description }}
                    </span>
                </p>
                <p class="col-md-2">{{ this.log.causer_name }}</p>
                <p class="col-md-2">{{ this.log.created }}</p>
            </div>
        </template>
    </component-card>
</template>
<script>
    export default {
        props: {
            ths: {
                type: Array,
                default: () => []
            },
            log: {
                type: Object
            },
        },
        data(){
            return {
                token: '',
            }
        },
        methods: {
            classStatus(status) {
                switch (status) {
                    case 'created':
                        return 'bg-gradient-success';
                    case 'updated':
                        return 'bg-gradient-warning';
                    case 'deleted':
                        return 'bg-gradient-danger';
                    default:
                        return '';
                }
            },
            hasChanged(key) {
                return (
                    this.log.properties?.old &&
                    key in this.log.properties.old &&
                    this.log.properties.old[key] !== this.log.properties.attributes?.[key]
                )
            },
            formatValue(value) {
                if (value === null || value === undefined) return '—'
                if (typeof value === 'boolean') return value ? 'Sim' : 'Não'
                if (typeof value === 'object') return JSON.stringify(value)
                return value
            }
        },
        mounted() {
            this.token = document.head.querySelector('meta[name="csrf-token"]')?.content;
        }
    }
</script>