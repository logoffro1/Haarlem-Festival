import { notification } from './notification.js';
import { breadcrumbs } from './breadcrumbs.js';
import { countdown } from './countdown.js';
import { tabs } from './tabs.js';

document.addEventListener("DOMContentLoaded", (event) => {
    new notification();
    new breadcrumbs();
    new countdown();
    new tabs();
});