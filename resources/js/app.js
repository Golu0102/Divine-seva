import './bootstrap';
import { createIcons, icons } from 'lucide';

document.addEventListener('DOMContentLoaded', () => {
    createIcons({ icons });
});

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

