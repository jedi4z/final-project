<?php

/**
 * Este archivo contiene todas las funciones necesarias que dan soporte
 * a toda la aplicacion, por ende estas funciones son ayudantes (helpers) 
 * 
 * @package Funciones
 * @name ayudantes.php
 * @author Jesús Díaz
 * @copyright Agilecode.
 */

/**
 * La funcion se encarga de conectar la aplicacion con la
 * base de datos, configurando previamente los parametros
 * de coneccion.
 * 
 * @param $server
 * @param $username
 * @param $passwordDb
 * @param database_name
 * 
 * @return boolean 
 */
function conectarDb() {

    /**
     * Parametros de configuracion de la coneccion
     * se deben editar segun con que base de datos se va a 
     * conectar.
     */
    $server        = "localhost";
    $username      = "root";
    $passwordDb    = "barracuda";
    $database_name = "notiexpress";

    /**
     * Aqui se conecta la base de datos con la funcion 'mysql_connect'
     * la cual devuelve verdadero si se puede conectar y falso si 
     * si no se puede conectar. 
     */
    if (mysql_connect($server, $username, $passwordDb)) {
        /**
         * Si devuelve verdadero se selecciona la base de datos con la funcion
         * 'mysql_select_db' si es verdadero retorna verdadero la funcion conectarDb()
         * en cuestion. 
         */
        if (mysql_select_db($database_name)) {
            /**
             * retorna verdadero si selecciona la base de datos 'notiexpress'
             */
            return true;
        } else {
            /**
             * retorna falso si NO selecciona la base de datos 'notiexpress'
             */
            return false;
        }
    } else {
        /**
         * Devuelve falso si no puede conectar la base de datos. 
         */
        return false;
    }
}

?>
