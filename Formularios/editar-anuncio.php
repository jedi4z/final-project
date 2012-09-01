<?php 
/**
 * @package Formularios
 * @name editar-anuncio.php
 * @author Jesús Díaz
 * @copyright Agilecode.
 *
 *  Se incluye el archivo funciones-anuncios.php
 */
require_once __DIR__ . '/../Funciones/funciones-anuncios.php';
/**
 * Recibo las variables del formulario a traves de la matriz POST
 * y las guardo en variables locales.
 */
$idAnuncio   = $_POST['idAnuncio'];
$urlFoto     = $_POST['urlFoto'];
$titulo      = $_POST['titulo'];
$categoria   = $_POST['categoria'];
$precio      = $_POST['precio'];
$descripcion = $_POST['descripcion'];

editarAnuncio ($idAnuncio, $urlFoto, $titulo, $categoria, $precio, $descripcion);
?>