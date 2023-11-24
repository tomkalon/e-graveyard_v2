/** @type {import('tailwindcss').Config} */
module.exports = {
    mode: process.env.NODE_ENV ? 'jit' : undefined,
    content: [
        "./assets/**/*.js",
        "./templates/**/**/*.html.twig",
        "./src/Form/**/*.php",
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
    ],
}
