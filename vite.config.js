import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/scss/dashboard.scss",
                "resources/scss/dashboard.scss",
                "resources/scss/auth-boxed.scss",
                "resources/scss/layouts/loader.scss",
                "resources/scss/assets/main.scss",
                "resources/layouts/loader.js",
                "resources/scss/plugins/perfect-scrollbar/perfect-scrollbar.scss",
                "resources/scss/layouts/structure.scss",
                "resources/scss/assets/components/list-group.scss",
                "resources/layouts/app.js",
                "resources/scss/plugins/table/datatable/dt-global_style.scss",
                "resources/scss/assets/pages/contact_us.scss",
                "resources/scss/plugins/tomSelect/custom-tomSelect.scss",

                "resources/scss/plugins/flatpickr/custom-flatpickr.scss",
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: "dist",
    },
});
