const reloj = {
    hours: 0,
    minutes: 0,
    seconds: 0,
    interval: null,
    hoursDom: null,
    minutesDom: null,
    secondsDom: null,

    init: function () {
        let self = this;

        this.hoursDom = $('#hours');
        this.minutesDom = $('#minutes');
        this.secondsDom = $('#seconds');
        this.interval = setInterval(function () {
            self.intervalCallback.apply(self);
        }, 1000);

    },
    toDoubleDigit: function (num) {
        if (num < 10) {
            return "0" + parseInt(num, 10);
        }
        return num;
    },

    updateDom: function () {
        this.hoursDom.text(this.toDoubleDigit(this.hours));
        this.minutesDom.text(this.toDoubleDigit(this.minutes));
        this.secondsDom.text(this.toDoubleDigit(this.seconds));
    },

    intervalCallback: function () {
        this.hours = new Date().getHours();
        this.minutes = new Date().getMinutes();
        this.seconds = new Date().getSeconds();
        this.updateDom();
    }

};

$(document).ready(function () {
    reloj.init();
});