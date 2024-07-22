import preset from "./vendor/filament/support/tailwind.config.preset";

/** @type {import('tailwindcss').Config} */
export default {
  presets: [preset],
  content: [
    "./app/Filament/**/*.php",
    "./app/Livewire/**/*.php",
    "./app/View/Components/**/*.php",
    "./resources/views/**/*.blade.php",
    "./vendor/filament/**/*.blade.php",
],
  theme: {
    extend: {},
  },
  plugins: [],
}
