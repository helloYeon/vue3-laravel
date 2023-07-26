import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";

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
        include: ['ckeditor5-custom-build/build/ckeditor'],
      },
      build: {
        commonjsOptions: {
          include: ['ckeditor5-custom-build/build/ckeditor'],
        },
      },
});
