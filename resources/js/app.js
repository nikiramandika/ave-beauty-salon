import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('livewire:navigated', () => {
    window.HSStaticMethods.autoInit();
})