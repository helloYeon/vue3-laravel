<template>
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="content" class="col-form-label">みしゃる</label>
        </div>
        <div class="col-auto">
            <ckeditor
                :editor="editor"
                v-model="editorData"
                :config="editorConfig"
            ></ckeditor>
        </div>
        <p></p>
    </div>
    <button type="submit" class="btn btn-primary">登録</button>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, ref } from "vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default defineComponent({
    components: {},
    setup() {
        const state = reactive({});
        const editorData = ref("");
        onMounted(async () => {});

        return {
            state,
            editor: ClassicEditor,
            editorData,
            editorConfig: {},
        };
    },
});
</script>
