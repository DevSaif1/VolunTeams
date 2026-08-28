import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    50: '#F0FDF4',
                    100: '#DCFCE7',
                    200: '#BBF7D0',
                    300: '#86EFAC',
                    400: '#4ADE80',
                    500: '#22C55E',
                    600: '#16A34A',
                    700: '#15803D',
                    800: '#166534',
                    900: '#14532D',
                },

                gold: {
                    50: '#FFFBEB',
                    100: '#FEF3C7',
                    200: '#FDE68A',
                    300: '#FCD34D',
                    400: '#FBBF24',
                    500: '#F59E0B',
                    600: '#D97706',
                    700: '#B45309',
                },

                ink: '#172033',
                muted: '#64748B',
                surface: '#F8FAFC',
                line: '#E2E8F0',
            },

            fontFamily: {
                sans: ['Inter', 'Cairo', ...defaultTheme.fontFamily.sans],
                display: ['Plus Jakarta Sans', 'Cairo', 'sans-serif'],
                arabic: ['Tajawal', 'Cairo', 'sans-serif'],
            },

            boxShadow: {
                soft: '0 1px 3px rgba(15, 23, 42, 0.06), 0 8px 24px rgba(15, 23, 42, 0.04)',
            },

            borderRadius: {
                xl: '0.875rem',
            },
        },
    },

    plugins: [forms],
};