module.exports = {
  plugins: {
    'postcss-import': {},
    'tailwindcss/nesting': {},
    tailwindcss: { config: './resources/css/tailwind.config.js' },
    autoprefixer: {},
  },
};
