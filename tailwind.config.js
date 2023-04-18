/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/**/**/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
],
  theme: {
    fontSize: {
      'primary-font': '16px',
    },
    gridTemplateColumns: {
      '2': '1.1fr 0.9fr'
    },
    borderColor: {
      'error': '#CC1E1E',
      'success': '#249E2C',
    },
    colors: {
      primary: '#2029F3',
      link: '#2029F3',
      gray: '#808189',
      'black': '#010414',
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

