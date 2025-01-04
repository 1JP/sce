<template>
    <div :class="['card', classCard]">
        <div :class="['card-header', classHeader]" v-if="cardHeader">
            <slot name="header" />
        </div>
        <div :class="['card-body', classBody]" v-if="cardBody">
            <slot name="body" />
        </div>
        <div :class="['card-footer', classFooter]" v-if="cardFooter">
            <slot name="footer" />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        cardHeader: {
            type: Boolean,
            default: false,
        },
        cardBody: {
            type: Boolean,
            default: false,
        },
        cardFooter: {
            type: Boolean,
            default: false,
        },
        classHeader: {
            type: String,
            default: '',
        },
        classBody: {
            type: String,
            default: '',
        },
        classFooter: {
            type: String,
            default: '',
        },
        classCard: {
            type: String,
            default: '',
        }
    },
};
</script>
