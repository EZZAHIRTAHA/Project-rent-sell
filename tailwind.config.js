/** @type {import('tailwindcss').Config} */ 
const flowbitePlugin = require("flowbite/plugin");
const formsPlugin = require("@tailwindcss/forms");

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                car: ["Rubik", "Poppins", "sans-serif"],
            },
            colors: {
                pr: {
                    100: "#e0f2ff",
                    200: "#b3e1ff",
                    300: "#80cfff",
                    400: "#4dbdff",
                    500: "#1aa9ff", // brighter blue
                    600: "#0094e6",
                    700: "#007acc",
                    800: "#005fa3",
                    900: "#00457a",
                },
                sec: {
                    100: "#fafafa",
                    200: "#ffd799",
                    300: "#f7f7f8",
                    400: "#f5f5f6",
                    500: "#dddddd",
                    600: "#eeeeee",
                    700: "#c4c4c4",
                    800: "#acacac",
                    900: "#acacac",
                },
            },
        },
    },
    plugins: [flowbitePlugin, formsPlugin],
};
