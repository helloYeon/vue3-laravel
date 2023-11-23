<template>
    <div class="container">
        <p></p>
        <p>welcome to vue-sample!</p>
        <h1>{{ state.count }}</h1>
        <button type="button" @click="btnClick" class="btn btn-primary">
            Bootstrap btn ({{ state.count }})
        </button>
    </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive } from "vue";
import axios from "axios";

export default defineComponent({
    components: {},
    setup() {
        const state = reactive({
            count: 0,
        });

        const btnClick = (): void => {
            state.count++;
        };

        onMounted(async () => {
            axios
                .get("https://my-json-server.typicode.com/typicode/demo/db")
                .then((response) => {
                    alert("called");
                    console.log(response.data);
                })
                .catch((error) => {
                    console.error(error);
                });
        });

        return {
            state,
            btnClick,
        };
    },
});
</script>
