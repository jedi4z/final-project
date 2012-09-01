<?php

/**
 * Este archivo recibe los datos del formulario, las guarda en varibles
 * Luego las envia a la funcion "cargarAnuncio()" para guardar los datos
 * en la base de datos.
 * 
 * @package Formularios
 * @name cargar-anuncio.php
 * @author Jesús Díaz
 * @copyright Agilecode.
 */
/**
 *  Se incluye el archivo funciones-anuncios.php
 */
require_once __DIR__ . '/../Funciones/funciones-anuncios.php';

$urlFoto     = $_POST["urlFoto"];
$titulo      = $_POST["titulo"];
$precio      = $_POST["precio"];
$categoria   = $_POST["categoria"];
$descripcion = $_POST["descripcion"];

cargarAnuncio($urlFoto, $titulo, $precio, $categoria, $descripcion);

?>