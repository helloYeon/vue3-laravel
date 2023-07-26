<template>
    <div class="container">
        <p></p>
        <p>welcome to vue-sample!</p>
        <h1>{{ state.count }}</h1>
        <button type="button" @click="btnClick" class="btn btn-primary">
            Bootstrap btn ({{ state.count }})
        </button>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="content" class="col-form-label">内容</label>
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
import { defineComponent, onMounted, reactive } from "vue";

export default defineComponent({
    components: {},
    setup() {
        const state = reactive({
            count: 0,
        });

        const btnClick = (): void => {
            state.count++;
        };

        onMounted(async () => {});

        return {
            state,
            btnClick,
        };
    },
});
</script>
