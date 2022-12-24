/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./app/view/components/header.phtml'],
  theme: {
    screens: {
      'sm': '480px',
      'md': '768px',
      'lg': '976px',
      'xl': '1440px'
    },
    extend: {
      
      colors: {
        dark: '#1e293b',
        light: '#f8fafc',
        secondary: '#94a3b8',
      },
    },
  },
  plugins: [],
}
