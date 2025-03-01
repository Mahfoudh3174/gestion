/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./src/**/*.{html,js,ts,jsx,tsx}", // Ajustez selon votre structure de projet
    ],
    theme: {
      extend: {
        colors: {
          primary: "#1E3A8A", // Bleu foncé personnalisé
          secondary: "#9333EA", // Violet personnalisé
        },
        fontFamily: {
          sans: ["Inter", "sans-serif"],
          serif: ["Merriweather", "serif"],
        },
      },
    },
    plugins: [],
  };
  