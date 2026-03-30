// tailwind.config.js
/** @type {import('tailwindcss').Config} */
module.exports = {
   darkMode: 'class', // <--- This MUST be here and exactly like this

   content: [
       // Ensure ALL files where you use Tailwind classes are listed here.
       // This is crucial for Tailwind to compile the dark: variants.
       "./resources/**/*.blade.php",
       "./resources/**/*.js",
       "./resources/**/*.vue",
       // If you're using Laravel's default pagination or other vendor views:
       "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
       // VERY IMPORTANT for Livewire/Volt:
       "./app/Livewire/**/*.php",
       "./resources/views/livewire/**/*.blade.php",
       // If you have custom Blade components outside these paths, add them too:
       // "./resources/views/components/**/*.blade.php",
   ],
   theme: {
       extend: {
           // Keep this empty if you're not extending default Tailwind values
       },
   },
   plugins: [
       require('@tailwindcss/forms'), // Common plugin, include if you use it
       // Other Tailwind plugins you might have
   ],
};