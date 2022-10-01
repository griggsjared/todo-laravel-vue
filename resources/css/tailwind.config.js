const colors = require('tailwindcss/colors')
const forms = require('@tailwindcss/forms')

module.exports = {
  mode: 'jit',
  content: [
      './resources/views/**/*.blade.php',
      './resources/scripts/**/*.js',
      './resources/vue/**/*.vue',
  ],
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      blue: {
        light: '#3b5ed1',
        dark: '#102055'
      },
      red: '#a50101',
      gray: {
        lighter: '#fafafa',
        lighter: '#f3f3f3',
        base: '#999999',
        dark: '#525252',
        darker: '#424349'
      },
    },
    fontFamily: {
      sans: ['Poppins', 'sans-serif']
    },
  },
  plugins: [
    forms
  ]
}
