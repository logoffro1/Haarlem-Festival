import { base } from './base.js';

export class dropdown extends base {
    constructor(){
        super();
        this.config = {
            selector: '.js-dropdown',
            activeClass: 'is-active'
        };
        this.init();
    }

    init(){
        const element = document.querySelector(this.config.selector);

        if(!this._exist(element)) return;
        
        this.config.selector = element;

        this.findChildElements();
    }

    findChildElements(){
        const { selector } = this.config;

        const dropdownAnchor = selector.querySelector('.js-dropdown__anchor');
        const dropdownBody = selector.querySelector('.js-dropdown__body');

        this.createEventListeners(dropdownAnchor, dropdownBody);
    }

    createEventListeners(el, targetEl){
        const { activeClass } = this.config;

        el.addEventListener('click', (event) => {
            event.preventDefault();
            
            if (targetEl.classList.contains(activeClass)){
                targetEl.classList.remove(activeClass);
            } else {
                targetEl.classList.add(activeClass);
            }
        });
    }
}
