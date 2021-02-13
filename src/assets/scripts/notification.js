import { base } from './base.js';

export class notification extends base {
    constructor(){
        super();
        this.config = {
            selector: '.js-notification'
        };
        this.init();
    }

    init(){
        const element = document.querySelector(this.config.selector);

        if(!this._exist(element)) return;
        
        this.config.selector = element;

        this.createEventListeners();
    }

    createEventListeners(){
        const { selector } = this.config;

        selector.addEventListener('click', () => {
            selector.classList.add('notification--cms--fade-out');
        });
    }
}
