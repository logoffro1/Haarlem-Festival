import { base } from './base.js';

export class tabs extends base {
    constructor(){
        super();
        this.config = {
            selector: '.js-tabs',
            toggleClass: 'is-active',
        };
        this.init();
    }

    init(){
        const element = document.querySelector(this.config.selector);

        if(!this._exist(element)) return;
        
        this.config.selector = element;

        this.findChildElements();
        this.createEventListeners();
    }

    findChildElements(){
        const { selector } = this.config;
        this.config.navigation = selector.querySelectorAll('.js-tabs-navigation a');
        this.config.content = selector.querySelectorAll('.js-tab-content');
    }

    createEventListeners(){
        const { navigation } = this.config;
        
        navigation.forEach(el => {
            el.addEventListener('click', () => {
                this.switchTabs(el);
            });
        });
    }

    switchTabs(el){
        const { navigation, content, toggleClass } = this.config;

        navigation.forEach(n => n.classList.remove(toggleClass));

        content.forEach(c => {
            c.classList.remove(toggleClass);

            if(c.dataset.content === el.dataset.content){
                c.classList.add(toggleClass);
                el.classList.add(toggleClass);
            }
        });
    }
}
