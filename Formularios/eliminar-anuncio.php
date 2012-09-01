<?php
/**
 * Este archivo se encarga de recibir el id del anuncio
 * para ser borrado, luego llama al metodo eliminarAnuncio()
 * y le pasa por parametro el id del anuncio para ser eliminado.
 *
 * @package Formularios
 * @name eliminar-anuncio.php
 * @author Jesús Díaz
 * @copyright Agilecode.
 */
/**
 *  Se incluye el archivo funciones-anuncios.php
 */
require_once __DIR__ . '/../Funciones/funciones-anuncios.php';

$idAnuncio = $_GET['idAnuncio'];

eliminarAnuncio($idAnuncio);

?>