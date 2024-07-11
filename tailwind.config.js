import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                pearl: ["TANPEARL", "sans-serif"],
                apercu: ["Apercu", "serif"],
                //SF Pro
                sfpro: ["SF-Pro", "sans-serif"],
                sfprodisplay: ["SF-Pro-Display, 'sans-serif"],
            },
            colors: {
                olivegreen: "#97A97C",
            },
        },
    },

    plugins: [forms, typography],
};
