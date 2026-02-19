<template>
  <file-pond
    ref="pond"
    :name="name"
    :files="pondFiles"
    :allow-multiple="true"
    :allow-reorder="true"
    :max-file-size="'3MB'"
    :max-files="10"
    image-preview-max-height="150"
    :accepted-file-types="['image/jpeg', 'image/png']"
    :credits="false"
    label-idle='
      <div class="col-lg-12">
        <h5 class="text-center">Arraste e solte suas Imagens aqui</h5>
        <p class="text-center">
          Máximo de 10 imagens. Tamanho máximo 3MB.<br>
          Para maior qualidade envie imagens no formato JPG ou PNG.
        </p>
      </div>'
    @updatefiles="handleUpdateFiles"
    @input="handleInput"
    @processfile="handleFilePondProcessFile"
    @removefile="handleRemoveFile"
  />
</template>

<script>
import { ref, watch } from "vue";
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

const csrf = document.head.querySelector('meta[name="csrf-token"]')?.content;

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
    name: "FileUpload",
    components: { FilePond },

    props: {
        name: { type: String, default: "files" },
        files: { type: Array, default: () => [] },
    },

    emits: ["update:files", "input"],

    setup(props, { emit, expose }) {
        const pondFiles = ref([]);
        const internalChange = ref(false); // evita loop ao carregar arquivos iniciais

        // 🔹 sincroniza arquivos do pai (create/edit)
        watch(
            () => props.files,
            (newFiles) => {
                if (!newFiles || !newFiles.length) {
                    pondFiles.value = [];
                    return;
                }

                internalChange.value = true;
                pondFiles.value = newFiles.map(file => ({
                    source: file.link || file,
                    options: {
                        metadata: {
                            id: file.id || ''
                        }
                    }
                }));
            },
            { immediate: true }
        );

        // 🔹 updatefiles event
        const handleUpdateFiles = (fileItems) => {
            if (internalChange.value) {
                internalChange.value = false;
                return;
            }
            const files = fileItems.map(i => i.file);
                emit("update:files", files);
        };

        // 🔹 input event
        const handleInput = (event) => {
            if (internalChange.value) return;
                emit("input", event);
        };

        // 🔹 processfile event
        const handleFilePondProcessFile = () => {
            pondRef.value?.processFiles();
        };

        const handleRemoveFile = (error, file) => {
            if (error) {
                console.error("Erro ao remover arquivo:", error);
                return;
            }
            emit("removeFiles", file.getMetadata('id'));
            // Aqui você pode chamar API para deletar no backend, se não estiver usando server.revert
        };

        // 🔹 expose reset
        const pondRef = ref(null);
        const reset = () => pondRef.value?.removeFiles();
        expose({ reset });

        return { pondFiles, handleUpdateFiles, handleInput, handleFilePondProcessFile, pondRef, reset, handleRemoveFile };
    }
};
</script>
