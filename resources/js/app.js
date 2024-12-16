// resources/js/app.js

import './bootstrap'; // File bootstrap.js yang disediakan Laravel

// Jika Anda menggunakan library tambahan, dapat ditambahkan di sini
import { createApp } from 'vue'; // Contoh jika menggunakan Vue.js

// Inisialisasi aplikasi Vue (jika digunakan)
const app = createApp({
    data() {
        return {
            message: 'Hello, Laravel with Vite!' 
        };
    },
    mounted() {
        console.log(this.message);
    }
});

// Mount aplikasi Vue ke elemen HTML dengan ID "app"
app.mount('#app');
