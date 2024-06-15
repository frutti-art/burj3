import typography from '@tailwindcss/typography';
import forms from '@tailwindcss/forms';
import aspectRatio from '@tailwindcss/aspect-ratio';

const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    darkMode: 'selector',
    theme: {
        extend: {
            keyframes: {
                spinPause: {
                    '0%': { transform: 'rotate(0deg)' },
                    '10%': { transform: 'rotate(359deg)' },
                    '100%': { transform: 'rotate(359deg)' }, // stays at 359deg to create a pause effect
                },
                spinOnce: {
                    '0%': { transform: 'rotate(0deg)' },
                    '100%': { transform: 'rotate(359deg)' },
                },
            },
            animation: {
                spinPause: 'spinPause 2.5s linear infinite',
                spinOnce: 'spinOnce 0.5s linear 1',
            },
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [
        typography,
        forms,
        aspectRatio,
        require("daisyui")
    ],
    daisyui: {
        themes: [
            // "light", "dark", "acid", "lofi", "retro", "black", "cyberpunk", "winter", "dim", "luxury",
            // {
            //     dracula: {
            //         ...require("daisyui/src/theming/themes")["dracula"],
            //         primary: "#05A3D4",
            //         // "base-100": "#121B25",
            //         // secondary: "teal",
            //     },
            // }
        ],
    },
}
