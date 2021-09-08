module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {},
        container: {
            center: true,
        },
        minHeight: {
            '0': '0',
            '1/4': '25%',
            '1/2': '50%',
            '3/4': '75%',
            'full': '100%',
        },
        extends: {
            colors: {
                "light-blue": "88CCF1",
                "sizzling-red": "EB5160",
                "majorelle-blue": "623CEA",
                "lavender-blush": "FFE9F3",
            }
        }
    },
    variants: {
        extend: {},
    },
    plugins: [],
}