<template>
    <div class="modal fade" :id="name" tabindex="-1" role="dialog" :aria-labelledby="name" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div :class="['modal-header', classHeader]">
              <h4 class="modal-title" :id="name">{{ title }}</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <slot/>
            </div>
            <div class="modal-footer">
                <slot name="footer"/>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            title: {
                type: String,
                required: false,
            },
            name: {
                type: String,
                required: true,
            },
            classHeader: {
                type: String,
                required: false,
            }
        },
    }
</script>
