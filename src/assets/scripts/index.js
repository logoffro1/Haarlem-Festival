import { notification } from './notification.js';
import { countdown } from './countdown.js';
import { tabs } from './tabs.js';

document.addEventListener("DOMContentLoaded", (event) => {
    new notification();
    new countdown();
    new tabs();
});