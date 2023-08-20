module.exports = {
    darkMode: 'class',
    content: ['./resources/views/**/*.blade.php'],
    theme: {
        extend: {
            animation: {
                headjar: 'headjar 60s ease-in-out infinite',
            },
            keyframes: {
                headjar: {
                    '0%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(100%)' },
                    '100%': { transform: 'translateY(0)' },
                }
            }
        }
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
