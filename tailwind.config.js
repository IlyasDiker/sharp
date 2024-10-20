import plugin from 'tailwindcss/plugin';
import containerQueries from '@tailwindcss/container-queries';
// import forms from '@tailwindcss/forms';
import animate from 'tailwindcss-animate';
import defaultTheme from 'tailwindcss/defaultTheme';
import flattenColorPalette from 'tailwindcss/src/util/flattenColorPalette.js';

/** @type {import('tailwindcss').Config} */
const config = {
    darkMode: ["class"],
    safelist: ["dark"],
    prefix: "",

    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/js/components/ui/**/*.ts',
    ],

    theme: {
        // screens: {
        //     sm: '640px',
        //     md: '768px',
        //     lg: '1024px',
        //     xl: '1280px',
        //     '2xl': '1536px',
        // },
        container: {
            center: true,
            padding: "2rem",
            screens: {
                "2xl": "90rem",
            },
        },
        extend: {
            boxShadow: {
                'l-xl': '0 0px 25px -5px rgb(0 0 0 / 0.1), 0 0px 10px -6px rgb(0 0 0 / 0.1)',
            },
            fontFamily: {
                'sans': ['geist-sans', ...defaultTheme.fontFamily.sans]
            },
            colors: {
                border: "hsl(var(--border))",
                input: "hsl(var(--input))",
                ring: "hsl(var(--ring))",
                background: "hsl(var(--background))",
                foreground: "hsl(var(--foreground))",
                primary: {
                    DEFAULT: "oklch(var(--primary-oklch) / <alpha-value>)",
                    foreground: "hsl(var(--primary-foreground))",
                    50: 'var(--color-primary-50)',
                    100: 'var(--color-primary-100)',
                    200: 'var(--color-primary-200)',
                    300: 'var(--color-primary-300)',
                    400: 'var(--color-primary-400)',
                    500: 'var(--color-primary-500)',
                    600: 'var(--color-primary-600)',
                    700: 'var(--color-primary-700)',
                    800: 'var(--color-primary-800)',
                    900: 'var(--color-primary-900)',
                },
                secondary: {
                    DEFAULT: "hsl(var(--secondary))",
                    foreground: "hsl(var(--secondary-foreground))",
                },
                destructive: {
                    DEFAULT: "hsl(var(--destructive))",
                    foreground: "hsl(var(--destructive-foreground))",
                },
                muted: {
                    DEFAULT: "oklch(var(--muted-oklch) / <alpha-value>)",
                    foreground: "oklch(var(--muted-foreground-oklch) / <alpha-value>)",
                },
                accent: {
                    DEFAULT: "hsl(var(--accent))",
                    foreground: "hsl(var(--accent-foreground))",
                },
                popover: {
                    DEFAULT: "hsl(var(--popover))",
                    foreground: "hsl(var(--popover-foreground))",
                },
                card: {
                    DEFAULT: "hsl(var(--card))",
                    foreground: "hsl(var(--card-foreground))",
                },
            },
            borderRadius: {
                xl: "calc(var(--radius) + 4px)",
                lg: "var(--radius)",
                md: "calc(var(--radius) - 2px)",
                sm: "calc(var(--radius) - 4px)",
            },
            keyframes: {
                "accordion-down": {
                    from: { height: 0 },
                    to: { height: "var(--radix-accordion-content-height)" },
                },
                "accordion-up": {
                    from: { height: "var(--radix-accordion-content-height)" },
                    to: { height: 0 },
                },
                "collapsible-down": {
                    from: { height: 0 },
                    to: { height: 'var(--radix-collapsible-content-height)' },
                },
                "collapsible-up": {
                    from: { height: 'var(--radix-collapsible-content-height)' },
                    to: { height: 0 },
                },
            },
            animation: {
                "accordion-down": "accordion-down 0.2s ease-out",
                "accordion-up": "accordion-up 0.2s ease-out",
                "collapsible-down": "collapsible-down 0.2s ease-in-out",
                "collapsible-up": "collapsible-up 0.2s ease-in-out",
            },
        },
    },
    plugins: [
        animate,
        containerQueries,
        plugin(function ({ matchUtilities, theme }) {
            const fallbackColor = (value) => {
                const color = typeof value === 'function' ? value({ opacityVariable: '--tw-bg-opacity', opacityValue: `var(--tw-bg-opacity)` }) : value;
                return [
                    color.replace('oklch(var(--primary-oklch)', 'hsl(var(--primary)'),
                    color.replace('oklch(var(--muted-oklch)', 'hsl(var(--muted)'),
                    color.replace('oklch(var(--muted-foreground-oklch)', 'hsl(var(--muted-foreground)'),
                ].find(replaced => replaced !== color);
            }
            matchUtilities(
                {
                    'bg': (value) => {
                        const color = fallbackColor(value);
                        return color ? {
                            '@supports not (color: oklch(0 0 0))': {
                                'background-color': color,
                            }
                        } : null;
                    },
                },
                { values: flattenColorPalette(theme('backgroundColor')), type: ['color'] }
            );
            matchUtilities(
                {
                    'text': (value) => {
                        const color = fallbackColor(value);
                        return color ? {
                            '@supports not (color: oklch(0 0 0))': {
                                'color': color,
                            }
                        } : null;
                    },
                },
                { values: flattenColorPalette(theme('textColor')), type: ['color'] }
            );
            matchUtilities(
                {
                    'border': (value) => {
                        const color = fallbackColor(value);
                        return color ? {
                            '@supports not (color: oklch(0 0 0))': {
                                'border-color': color,
                            }
                        } : null;
                    },
                },
                { values: flattenColorPalette(theme('borderColor')), type: ['color'] }
            );
        }),
        // plugin(function ({ matchUtilities, theme }) {
        //     matchUtilities({
        //         'gap-x': (value) => {
        //             return {
        //                 'column-gap': value,
        //                 '--gap-x': value,
        //             };
        //         },
        //         'gap-y': (value) => {
        //             return {
        //                 'row-gap': value,
        //                 '--gap-y': value,
        //             };
        //         },
        //     }, { values: theme('gap') });
        // }),
    ],
}

export default config;
