import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                heading: ['"Kelly Slab"', "cursive"],
            },
            colors: {
                primary: "#FFD600", // Main yellow
                secondary: "#BB7614", // Brown
                accent: "#FFC403", // Accent yellow
            },
        },
    },

    plugins: [forms],
};
