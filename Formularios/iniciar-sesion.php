<?php

/**
 * Este archivo recibe los datos del formulario, las guarda en varibles
 * por ejemplo $usuario, $password.
 * Luego las envia a la funcion "iniciarSesion()" que
 * se encuentra en el archivo funciones-usuario.php
 * 
 * @package Formularios
 * @name iniciar-sesion.php
 * @author Jesús Díaz
 * @copyright Agilecode.
 */
/**
 *  Se incluye el archivo funciones-usuario.php
 */
require_once __DIR__.'/../Funciones/funciones-usuario.php';
/**
 * Guardo los datos del formulario en
 * variables. 
 */
$usuario  = $_POST["usuario"];
$password = $_POST["password"];
/**
 * Las envio a la funcion iniciarSesion(). 
 */
iniciarSesion($usuario, $password);
?>
