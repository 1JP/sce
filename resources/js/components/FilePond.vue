<template>
  <file-pond
    :name="name"
    ref="pond"
    label-idle='<div class="col-lg-12">
                <h5 class="text-center">Arraste e solte suas Imagens aqui</h5>
                <p class="text-center">Máximo de 10 imagens. Tamanho máximo 3MB.&nbsp;<br>Para maior qualidade envie imagens no formato JPG ou PNG.</p>
            </div>'
    :allow-multiple="true"
    :allow-reorder="true"
    maxFileSize="'3MB'"
    maxFiles="10"
    imagePreviewMaxHeight="150"
    v-on:input="handleInput"
    v-on:processfile="handleFilePondProcessFile"
    :accepted-file-types="[
      'image/jpeg',
      'image/png',
    ]"
    credits="false"
  />
</template>

<script>
    import vueFilePond, { setOptions } from "vue-filepond";
    import "filepond/dist/filepond.min.css";
    import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
    import FilePondPluginImagePreview from "filepond-plugin-image-preview";
    import FilePondPluginFileEncode from 'filepond-plugin-file-encode';
    import FilePondPluginFileRename from 'filepond-plugin-file-rename';
    import FilePondPluginFileMetadata from 'filepond-plugin-file-metadata';
    import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
    import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
    import FilePondPluginImageTransform from 'filepond-plugin-image-transform';
    import FilePondPluginImageResize from 'filepond-plugin-image-resize';

    import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

    const csrf = document.head.querySelector('meta[name="csrf-token"]').content;

    setOptions({
        server: {
            url: "/filepond",
            headers: {
                'X-CSRF-TOKEN': csrf,
            }
        }
    });
    
    const FilePond = vueFilePond(
        FilePondPluginFileEncode,
        FilePondPluginFileRename,
        FilePondPluginFileMetadata,
        FilePondPluginFileValidateType,
        FilePondPluginImageExifOrientation,
        FilePondPluginImageCrop,
        FilePondPluginImageTransform,
        FilePondPluginImageResize,
        FilePondPluginImagePreview
    );

    export default {
        name: "file-upload",

        emits: ["input"],
        expose: ["reset"],

        components: {
            FilePond,
        },

        props: {
            name: {
                type: String,
                required: false,
                default: "files",
            },
            files: {
                type: Array,
                required: false,
                default: () => [],
            },
        },
        methods: {
            handleFilePondProcessFile: function () {
                this.$refs.pond.processFiles();
            },
            handleInput: function (event) {
                this.$refs.pond.getFiles()
            },
            reset: function () {
                this.$refs.pond.removeFiles();
            },
        },
    }
</script>
