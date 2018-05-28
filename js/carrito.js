"use strict";

class Carrito {

    constructor() {
        this.elementos = [];
    }

    actualizarCarro() {
        var carroCompra = document.getElementById("carroCompra");
        //Meter el nuevo elemento en el carro de la compra.
    }

    addElemento(nombre,precio){
        this.elementos.push({nombre:nombre,precio:precio});
    }

}

var carrito = new Carrito();