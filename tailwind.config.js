module.exports = {
  purge: [],
  purge: [
    './resources/common/blade.php',
    './resources/components/blade.php',
    './resources/layouts/blade.php',
    './resources/*.blade.php',
    './resources/**/*.blade.php',
  ],
   darkMode: false, // or 'media' or 'class'
   theme: {
     extend: {},
   },
   variants: {
     extend: {},
   },
   plugins: [],
 }