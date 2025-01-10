import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            colors: {
                blue: {
                100: '#dbeafe', // Biru sangat terang
                200: '#bfdbfe', // Biru terang
                300: '#93c5fd', // Biru sedang terang
                400: '#60a5fa', // Biru sedang
                500: '#3b82f6', // Biru utama
                600: '#2563eb', // Biru sedikit gelap
                700: '#1d4ed8', // Biru gelap
                800: '#1e40af', // Biru sangat gelap
                900: '#1e3a8a', // Biru lebih gelap
                1000: '#172554', // Biru paling gelap
                },
                yellow: {
                100: '#fef9c3', // Kuning sangat terang
                200: '#fef08a', // Kuning terang
                300: '#fde047', // Kuning sedang terang
                400: '#facc15', // Kuning sedang
                500: '#eab308', // Kuning utama
                600: '#ca8a04', // Kuning sedikit gelap
                700: '#a16207', // Kuning gelap
                800: '#854d0e', // Kuning sangat gelap
                900: '#713f12', // Kuning lebih gelap
                1000: '#422006', // Kuning paling gelap
            },
            green: {
                100: '#d1fae5', // Hijau sangat terang
                200: '#a7f3d0', // Hijau terang
                300: '#6ee7b7', // Hijau sedang terang
                400: '#34d399', // Hijau sedang
                500: '#10b981', // Hijau utama
                600: '#059669', // Hijau sedikit gelap
                700: '#047857', // Hijau gelap
                800: '#065f46', // Hijau sangat gelap
                900: '#064e3b', // Hijau lebih gelap
                1000: '#022c22', // Hijau paling gelap
            },


            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require('flowbite/plugin')],
};
