const map = {
    latitude: null,
    longitude: null,
    accuracy: null,
    mapDom: null,

    init: function () {
        let self = this;
        this.mapDom = $('#mapa');
        self.localizacionCliente();
    },

    localizacionCliente: function () {
        navigator.geolocation.getCurrentPosition(this.mostrarPosicion, this.mostrarErrores);
    },

    mostrarPosicion: function (position) {
        this.latitude = position.coords.latitude;
        this.longitude = position.coords.longitude;
        this.accuracy = position.coords.accuracy;
        this.mapDom.text("Latitud:" + this.latitude + ", Longitude:"
            + this.longitude + ", Accuracy:" + this.accuracy);
    },

    mostrarErrores: function (error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                this.mapDom.innerHTML = "User denied the request for Geolocation.";
                break;
            case error.POSITION_UNAVAILABLE:
                this.mapDom.innerHTML = "Location information is unavailable.";
                break;
            case error.TIMEOUT_ERR:
                this.mapDom.innerHTML = "The request to get user location timed out.";
                break;
            case error.UNKNOWN_ERR:
                this.mapDom.innerHTML = "An unknown error occurred.";
                break;
        }
    }
};

$(document).ready(function () {
    map.init();
});