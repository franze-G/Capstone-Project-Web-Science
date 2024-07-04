import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.css",
    ],

    theme: {
        colors: {
            black: "#151515",
            white: "#FFFFFF",
            green: "#97A97C",
            blue: "#0077B6",
        },
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                pearl: ["Pearl", "sans-serif"],
            },
        },
    },

    plugins: [forms],
};
