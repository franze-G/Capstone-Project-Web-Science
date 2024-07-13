import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    // mode: "jit", // JIT mode is enabled by default in Tailwind CSS v3
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                sfpro: ["SF-Pro", "sans-serif"],
                tanpearl: ["Tan-Pearl", "sans-serif"],
            },

            colors: {
                // Changed from 'color' to 'colors'
                black: "#151515",
                olivegreen: "#97A97C",
                yellow: "#ffd60a",
            },
        },
    },

    plugins: [forms, typography],
};
