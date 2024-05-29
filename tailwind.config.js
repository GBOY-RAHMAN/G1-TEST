/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: ["./src/**/*.{html,js}"],
  theme: {
    
    extend: { 
      backgroundImage: {
        'custom-image': "url('img/img1.webp')",
        'sign2-image': "url('img/img2.webp')",
        'sign3-image': "url('img/img3.webp')",
        'sign4-image': "url('img/img4.webp')",
        'sign5-image': "url('img/img5.jpg')",
        'sign6-image': "url('img/img6.jpg')",
        'sign7-image': "url('img/img7.jpg')",
        'sign8-image': "url('img/img8.jpg')",
      },
    },
  },
  plugins: [],
}