import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class', // <== permite alternar manualmente
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                sidebar: {
                    light: '#f9fafb', // fundo claro
                    dark: '#1f2937',  // fundo escuro (gray-800)
                },
                text: {
                    light: '#374151', // gray-700
                    dark: '#d1d5db',  // gray-300
                },
                accent: {
                    DEFAULT: '#2563eb', // azul para hover/ativo
                    dark: '#3b82f6',
                },
            },
        },
    },

    plugins: [forms],
}
