const map = {
    latitude: null,
    longitude: null,
    accuracy: null,
    mapDom: null,

    init: function () {
        this.localizacionCliente();
    },

    localizacionCliente: function () {
        navigator.geolocation.getCurrentPosition(this.mostrarPosicion, this.mostrarErrores);
    },

    mostrarPosicion: function (position) {
        this.mapDom = document.querySelector('#map');
        this.latitude = position.coords.latitude;
        this.longitude = position.coords.longitude;
        this.accuracy = position.coords.accuracy;
        this.mapDom.innerHTML = "Latitud:" + this.latitude + ", Longitude:"
            + this.longitude + ", Accuracy:" + this.accuracy;
    },

    mostrarErrores: function (error) {
        this.mapDom = document.querySelector('#map');
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

window.onload = function () {
    map.init();
};