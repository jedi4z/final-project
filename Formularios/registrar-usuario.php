<?php

/**
 * Este archivo recibe los datos del formulario, las guarda en varibles
 * por ejemplo $nombres, $apellidos, etc.
 * Luego las envia a la funcion "registrarUsuario()" que
 * se encuentra en el archivo funciones-usuario.php
 * 
 * @package Formularios
 * @name registrar-usuario.php
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
$nombres         = $_POST["nombres"];
$apellidos       = $_POST["apellidos"];
$fechaNacimiento = $_POST["fechaNacimiento"];
$email           = $_POST["email"];
$password        = $_POST["password"];
$repPassword     = $_POST["repPassword"];
/**
 * Las envio a la funcion registrarUsuario(). 
 */
registrarUsuario($nombres, $apellidos, $fechaNacimiento, $email, $password, $repPassword);
?>
