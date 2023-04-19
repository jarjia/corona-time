/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/**/**/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
],
  theme: {
    screens: {
      'sm': {'max': '640px'}
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
  ],
}

