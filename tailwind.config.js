/** @type {import('tailwindcss').Config} */
module.exports = {
    mode: process.env.NODE_ENV ? 'jit' : undefined,
    content: [
        "./assets/controllers/**/**/*.js",
        "./assets/js/modules/*.js",
        "./assets/js/views/**/*.js",
        "./templates/**/**/**/*.html.twig",
        "./src/Admin/UI/Form/**/*.php",
        "./src/Main/UI/Form/**/*.php",
        "./node_modules/tw-elements/dist/js/**/*.js"
    ],
    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                'mint': '#7da29e'
            },
        },
    },
    plugins: [
        require("tw-elements/dist/plugin.cjs"),
        require('@tailwindcss/forms'),
    ],
    darkMode: 'class',
}
