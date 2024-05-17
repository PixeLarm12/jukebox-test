/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./src/**/*.{vue,js}"],
    theme: {
      extend: {
        colors: {
            "default-blue": "#244fc7",
            "default-gray": "#636262",
        }
      },
    },
    plugins: [],
  }