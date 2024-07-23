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
                sans: ["Figtree", "sans-serif"],
                tanpearl: ["Tan-Pearl", "sans-serif"],
                sfpro: ["SF-Pro", "sans-serif"],
                sfprodisplay: ["SF-Pro-Display", "sans-serif"],
                sfprodisplayblack: ["SF-Pro-Display-Black", "sans-serif"],
                sfprorounded: ["SF-Pro-Rounded", "sans-serif"],
                apercu: ["Apercu", "sans-serif"],
            },

            colors: {
                // Changed from 'color' to 'colors'
                black: "#151515",
                yellow: "#ffd60a",
                gray: "#828282",
                lightgray: "#e9ecef",
                //greens
                emerald: "#718355",
                emeraldlight1: "#87986A",
                olivegreen: "#97A97C",
                emeraldlight2: "#CFE1B9",
                emeraldlight3: "#E9F5DB",
            },
            boxShadow: {
                innershadow: "inset 5px 5px 15px 5px rgba(207,225,185,0.40)", //emeraldlight2
            },
        },
    },

    plugins: [forms, typography],
};
