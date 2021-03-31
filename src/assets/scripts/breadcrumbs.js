import { base } from './base.js';

export class breadcrumbs extends base {
    constructor(){
        super();
        this.config = {
            selector: '.js-breadcrumbs'
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
        const children = this.config.selector.querySelectorAll('.breadcrumbs__breadcrumb');
        children.forEach((child, index) => {
            this.createEventListeners(child, index);
        });
    }


    createEventListeners(child, index){

        child.addEventListener('click', () => {
            history.go(-(index+1));
        });
    }
}
