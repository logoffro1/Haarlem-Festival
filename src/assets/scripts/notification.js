import { base } from './base.js';

export class notification extends base {
    constructor(){
        super();
        this.config = {
            selectors: '.js-notification'
        };
        this.init();
    }

    init(){
        const elements = document.querySelectorAll(this.config.selectors);

        if(!this._exist(elements)) return;
        
        this.config.selectors = elements;

        this.createEventListeners();
    }

    createEventListeners(){
        const { selectors } = this.config;
        const animationDuration = 500; // Should be the same value as in the _notification.scss

        selectors.forEach(selector => {
            selector.addEventListener('click', () => {
                selector.classList.add('notification--cms--fade-out');
                
                setTimeout(() => {
                    selector.classList.remove('notification--cms--is-visible');
                    selector.classList.remove('notification--cms--fade-out');
                }, animationDuration);
            });
        });
    }
}
