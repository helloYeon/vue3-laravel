import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";
import commonjs from "vite-plugin-commonjs";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/sass/app.scss",
                "resources/js/app.ts",
            ],
            refresh: true,
        }),
        vue(),
        commonjs({
            filter(id) {
                if (["ckeditor5/build/ckeditor.js"].includes(id)) {
                    return true;
                }
            },
        }),
    ],
    resolve: {
        extensions: [".ts", ".js", ".vue", ".json"],
        alias: {
            "@": path.join(__dirname, "/resources/js/"),
            "@pages": path.join(__dirname, "/resources/js/components/pages/"),
            "@asset": __dirname + "/resources/images/",
            "~": __dirname + "/node_modules",
        },
    },
    optimizeDeps: {
        include: ["ckeditor5-custom-build"],
    },
    build: {
        commonjsOptions: { exclude: ["ckeditor5-custom-build"] },
    },
});
