import { base } from './base.js';

export class countdown extends base {
    constructor(){
        super();
        this.config = {
            selector: '.js-countdown',
            endDate: null,
        };

        this.init();
    }

    init(){
        const element = document.querySelector(this.config.selector);

        if(!this._exist(element)) return;
        
        this.config.selector = element;
        this.config.endDate = new Date(Date.parse(this.config.selector.getAttribute('end-date')));

        this.findChildElements();
        this.initializeClock();
    }

    calculateTime(){
        const total = Date.parse(this.config.endDate) - Date.parse(new Date());
        const seconds = Math.floor( (total/1000) % 60 );
        const minutes = Math.floor( (total/1000/60) % 60 );
        const hours = Math.floor( (total/(1000*60*60)) % 24 );
        const days = Math.floor( total/(1000*60*60*24) );

        return {
            total,
            days,
            hours,
            minutes,
            seconds
        };
    }

    findChildElements(){
        this.config.days = document.querySelector('.js-countdown__days');
        this.config.hours = document.querySelector('.js-countdown__hours');
        this.config.minutes = document.querySelector('.js-countdown__minutes');
        this.config.seconds = document.querySelector('.js-countdown__seconds');
    }

    initializeClock(){
        const { days, hours, minutes, seconds, endDate } = this.config;
        const timeinterval = setInterval(() => {
            const t = this.calculateTime(endDate);

            days.innerHTML = t.days;
            hours.innerHTML = ('0' + t.hours).slice(-2);
            minutes.innerHTML = ('0' + t.minutes).slice(-2);
            seconds.innerHTML = ('0' + t.seconds).slice(-2);

            if (t.total <= 0) {
              clearInterval(timeinterval);
            }
          },1000);
    }
}