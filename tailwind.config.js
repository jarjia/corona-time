/** @type {import('tailwindcss').Config} */
const plugin = require('tailwindcss/plugin');

module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/**/**/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
],
  theme: {
    screens: {
      'sm': {'max': '625px'},
      'mediumHeight': {'raw': '(max-height: 745px)'},
      'minHeight': {'raw': '(min-height: 817px)'},
      '2xl': {'min': '1896px'}
    },
    fontSize: {
      'primary-font': '16px',
    },
    gridTemplateColumns: {
      session: '1.1fr 0.9fr',
      'one': '1fr'
    },
    borderColor: {
      'error': '#CC1E1E',
      'success': '#249E2C',
    },
    colors: {
      primary: '#2029F3',
      link: '#2029F3',
      gray: '#808189',
      error: '#CC1E1E',
    },
    backgroundColor: {
      'sign-up-btn': '#0FBA68',
    }
  },
  plugins: [
    require("@tailwindcss/forms")({
      strategy: 'base',
    }),
    plugin(({ addBase, theme }) => {
      addBase({
          '.scrollbar': {
              overflowY: 'auto',
              scrollbarColor: `#808189 transparent`,
              scrollbarWidth: 'thin',
          },
          '.scrollbar::-webkit-scrollbar': {
              height: '4px',
              width: '6px',
          },
          '.scrollbar::-webkit-scrollbar-thumb': {
              backgroundColor: '#808189',
              borderRadius: '50px'
          },
      });
  }),
  ],
}

