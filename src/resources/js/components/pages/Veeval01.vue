<template>
    <br /><br /><br />
    <div class="container">
        <form @submit="handleSubmit">
            <div class="input-field">
                <input type="text" v-model="text" />
                <p class="error-message">{{ textError }}</p>
            </div>
            <div class="input-field">
                <div><p>アカウントID</p></div>
                <input type="text" v-model="accountId" />
                <p class="error-message">{{ accountIdError }}</p>
            </div>
            <div class="input-field">
                <div><p>パスワード</p></div>
                <input type="text" v-model="password" />
                <p class="error-message">{{ passwordError }}</p>
            </div>
            <div class="input-field">
                <div><p>パスワード確認用</p></div>
                <input type="text" v-model="passwordConfirm" />
                <p class="error-message">{{ passwordConfirmError }}</p>
            </div>
            <button type="submit">送信</button>
        </form>
    </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, reactive, ref } from "vue";
import { useField, useForm } from "vee-validate";
import * as yup from "yup";

export default defineComponent({
    components: {},
    setup() {
        const state = reactive({});

        const formSchema = yup.object({
            text: yup.string().required("テキストは必須項目です"),
            accountId: yup
                .string()
                .matches(
                    /^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,32}$/i,
                    "アカウントIDの形式が間違っています。"
                ),
            password: yup.string().required("パスワードは必須項目です"),
            passwordConfirm: yup
                .string()
                .required("パスワード確認用は必須項目です")
                .oneOf([yup.ref("password")]),
        });

        useForm({ validationSchema: formSchema });

        const { value: text, errorMessage: textError } =
            useField<string>("text");
        const { value: accountId, errorMessage: accountIdError } =
            useField<string>("accountId");
        const { value: password, errorMessage: passwordError } =
            useField<string>("password");
        const { value: passwordConfirm, errorMessage: passwordConfirmError } =
            useField<string>("passwordConfirm");

        const handleSubmit = (e: Event) => {
            if (
                text.value &&
                !textError.value?.length &&
                accountId.value &&
                !accountIdError.value?.length &&
                password.value &&
                !passwordError.value?.length &&
                passwordConfirm.value &&
                !passwordConfirmError.value?.length
            ) {
                return true;
            }
            text.value = "";
            accountId.value = "";
            e.preventDefault();
        };

        onMounted(async () => {});

        return {
            text,
            textError,
            accountId,
            accountIdError,
            password,
            passwordError,
            passwordConfirm,
            passwordConfirmError,
            handleSubmit,
        };
        return {
            state,
        };
    },
});
</script>
