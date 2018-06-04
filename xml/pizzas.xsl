<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" indent="yes" version="1.0"/>
    <xsl:template match="/">
        <html lang="es">
            <head>
                <meta name="description" content="Página principal de la pagina web dedicada a la venta de pizzas"/>
                <meta name="keywords" content="pizzas, pizzeria, carta"/>
                <link rel="icon" href="../img/iconoPizza.jpg" type="image/jpg"/>
                <!-- Espacio para meter las hojas de estilos o los diferentes scrips-->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script type="text/javascript" src="../js/reloj.js" language="JavaScript"></script>
                <script type="text/javascript" src="../js/carrito.js" language="JavaScript"></script>
                <link href="../css/estilos.css" rel="stylesheet" type="text/css"/>
                <link href="../css/reloj.css" rel="stylesheet" type="text/css"/>
                <title>Pizzería EII</title>
            </head>
            <body>
                <div id="clockDate">
                    <p id="date"></p>
                    <ul id="clock">
                        <li id="hours"></li>
                        <li class="dot">:</li>
                        <li id="minutes"></li>
                        <li class="dot">:</li>
                        <li id="seconds"></li>
                    </ul>
                </div>

                <header>
                    <a href="../index.html" title="Ir a la página principal">Pizzería EII</a>
                </header>

                <nav>
                    <ul id="lista_menu">
                        <li>
                            <a href="../index.html">Principal</a>
                        </li>
                        <li>
                            <a href="../html/conocenos.html">Conócenos</a>
                        </li>
                        <li>
                            <a href="../html/productos.html">Productos</a>
                            <ul>
                                <li>
                                    <a href="../xml/pizzas.xml">Pizzas</a>
                                </li>
                                <li>
                                    <a href="../xml/pizzasEspeciales.xml">Pizzas Especiales</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="../html/contacto.html">Contacto</a>
                        </li>
                        <li>
                            <a href="../html/locales.html">Locales</a>
                        </li>
                    </ul>
                </nav>

                <main>
                    <aside>
                        <table id="carroCompra" hidden="true">
                            <tr>
                                <th>Pizza</th>
                                <th>Precio</th>
                            </tr>
                        </table>

                        <p id="total" hidden="true"></p>

                        <input hidden="true" type="button" id="pedido"
                               onclick="carrito.guardarPedido();" value="Tramitar pedido"/>
                    </aside>

                    <section>

                        <h1>Pizzas</h1>
                        <xsl:for-each select="pizzas/pizza">
                            <div>
                                <xsl:apply-templates select="rutaFoto"/>
                                <h3>
                                    <xsl:value-of select="nombre"/>
                                </h3>

                                <xsl:apply-templates select="."/>

                                <span>
                                    <strong>Ingredientes:
                                        <br></br>
                                    </strong>
                                    <xsl:for-each select="ingredientes/ingrediente">
                                        <xsl:value-of select="."/><xsl:text> </xsl:text>
                                    </xsl:for-each>
                                </span>
                                <span>
                                    <strong><br></br>Precio:
                                    </strong>
                                    <xsl:value-of select="precio"/>
                                </span>

                                <xsl:if test=" calorias != '' ">
                                    <span>
                                        <strong><br></br>Calorías:
                                            <br></br>
                                        </strong>
                                        <xsl:value-of select="calorias"/><xsl:text> </xsl:text><xsl:value-of
                                            select="calorias/@unidadCal"/><xsl:text> por </xsl:text><xsl:value-of
                                            select="calorias/@cantidad"/><xsl:text> </xsl:text><xsl:value-of
                                            select="calorias/@unidad"/>
                                    </span>
                                </xsl:if>
                            </div>
                        </xsl:for-each>
                    </section>
                </main>
                <footer>
                    <div>
                        <span>
                            &#169; Copyright 2018 - Pizzería EII - Derechos reservados
                        </span>
                        <span>
                            Pagina web hecha por:
                            <a href="mailto:uo236974@uniovi.es">Martín Peláez Díaz</a>
                        </span>
                    </div>

                    <div>
                        <h3>Mapa web</h3>
                        <ul>
                            <li>
                                <a href="../index.html">Principal</a>
                            </li>
                            <li>
                                <a href="../html/conocenos.html">Conócenos</a>
                            </li>
                            <li>
                                <a href="../html/productos.html">Productos</a>
                            </li>
                            <li>
                                <a href="../html/contacto.html">Contacto</a>
                            </li>
                            <li>
                                <a href="../html/locales.html">Locales</a>
                            </li>
                        </ul>
                    </div>

                    <div class="accesibilidad">

                    </div>
                </footer>
            </body>
        </html>
    </xsl:template>

    <xsl:template match="pizza">
        <input type="button" id="añadir" onclick="carrito.addElemento('{./nombre}','{./precio}');" value="Añadir"/>
    </xsl:template>

    <xsl:template match="rutaFoto">

        <a href="{.}">
            <xsl:text> </xsl:text>
            <img src="{.}" alt="imagen pizza">
            </img>
        </a>

    </xsl:template>
</xsl:stylesheet>