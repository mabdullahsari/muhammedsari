module.exports = {
    content: ['./resources/views/**/*.blade.php'],
    theme: {
        extend: {
            animation: {
                float: 'float 7s ease-in-out infinite',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0x) rotate(0deg)' },
                    '50%': { transform: 'translateY(50px) rotate(3deg)' },
                }
            }
        }
    },
    plugins: [],
}
