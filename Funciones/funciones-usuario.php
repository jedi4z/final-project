<?php

/**
 * Este archivo contiene todas las funciones que referencian a los 
 * comportamientos del usuario, ejemplo; crear un usuario, modificar
 * los datos del usuario etc.
 *
 * @package Funciones
 * @name funciones-usuario.php
 * @author Jesús Díaz
 * @copyright Agilecode.
 */
/**
 * Se inicia una sesion de usuario para poder hacer las 
 * validaciones de usuario con la funcion 'session_start()'.
 */
session_start();
/**
 * Se incluyen los 'ayudantes' (helpers) para poder utilizar las funciones 
 * que dan soporte a las funciones de usuario, por ejemplo, la coneccion con
 * la base de datos. 
 */
require_once 'ayudantes.php';

/**
 * La funcion recibe los parametros para registrar
 * un nuevo usuario, verifica que el email no se aya
 * registrado antes y que el password sea bien ingresado, si
 * todo es correcto, registra un nuevo usuario en la base
 * de datos.
 * 
 * @param type $nombres
 * @param type $apellidos
 * @param type $fechaNacimiento
 * @param type $email
 * @param type $password
 * @param type $repPassword 
 */
function registrarUsuario($nombres, $apellidos, $fechaNacimiento, $email, $password, $repPassword) {
    /**
     * Creo las cadenas con la consultas SQL.
     * $queryCrearUsuario crea un nuevo usuario insertando todos los datos pasados por parametro.
     * $queryVerificarMail busca el email que ingresa el usuario para verificar si existe.
     * $queryConsultarNuevoUsuario busca el nuevo usuario creado
     */
    $queryCrearUsuario          = "INSERT INTO usuarios (nombres, apellidos, fecha_nacimiento, email, password) VALUES ('$nombres', '$apellidos', '$fechaNacimiento', '$email', '$password')";
    $queryVerificarMail         = "SELECT email FROM usuarios WHERE email='$email'";
    $queryConsultarNuevoUsuario = "SELECT id FROM usuarios WHERE email='$email' AND password='$password'";
    /**
     * Verifico que se hayan ingresado todos los datos en el formulario.
     */
    if ($nombres != null && $apellidos != null && $fechaNacimiento != null && $email != null && $password != null && $repPassword != null) {
        /**
         *  Verifico si conectó la base de datos con la funcion del ayudante 'conectarDb()'
         */
        if (conectarDb()) {
            /**
             *  Verifico que las contraseñas ingresadas sean iguales.
             */
            if ($password == $repPassword) {
                /**
                 * Si son iguales verifico si el mail del usuario
                 * ya existe previamente, es decir se ha registrado antes
                 * con la query '$queryVerificarMail'
                 */
                $resultadoMail = mysql_query($queryVerificarMail);
                $fila = mysql_fetch_array($resultadoMail);
                if ($fila["email"] == "") {
                    /**
                     * Si el resultado es null, es decir que no se encuentra el mail en la base de datos
                     * se crea el usuario. 
                     */
                    mysql_query($queryCrearUsuario);
                    /**
                     * redirecioamos la pagina nuevamente al inicio 
                     * para que ya aparesca el panel del usuario y seteamos
                     * la variable de sesion 'idUser' para que ya aparesca logueado.
                     */
                    /*
                     * Realizo la consulta y almaceno el resultado en la variable $result.- 
                     * previamente conectando la base de datos con el metodo conectarDb()
                     * luego obtengo el array de resultados y lo recorro con un bucle while.
                     * obteniendo cada fila (row).   
                     */
                        $result        = mysql_query($queryConsultarNuevoUsuario);
                        $row           = mysql_fetch_array($result);
                        if ($row["id"] != null) {
                        $idUsuario     = $row["id"];
                    }
                    $_SESSION["idUser"] = $idUsuario;
                    header("Location: ../index.php");
                } else {
                    /**
                     * Si el mail no existe muestro un mensaje en pantalla indicando que
                     * ya se ha utilizado este email.
                     */
                    echo "Error: La direccion de email ya ha sido utiliada previamente para registrar un usuario, por favor verifique e intente de nuevo";
                }
            } else {
                /**
                 *  Si el password no coincide muestro un mensaje de error.
                 */
                echo "El password no coincide, por favor verifique he intente de nuevo.";
            }
        } else {
            /**
             *  Si no me puedo conectar con la base da datos, muestro un mensaje de error.
             */
            echo "ERROR: En este momento no se puede conectar la base da datos";
        }
    } else {
        echo "Error: debe ingresar todos los datos";
    }
}

/**
 * La funcion recibe dos parametros, el usario
 * y el password, si la convinacion de la misma existe
 * en la base de datos, permite el acceso al sistema 
 * al usuario, guardando el id de usuario en una variable
 * de sesion.
 * 
 * @param type $usuario
 * @param type $password 
 */
function iniciarSesion($usuario, $password) {
    /*
     *  Contruyo la consulta en un String, una cadena.
     */
    $query = "SELECT id FROM usuarios WHERE email='$usuario' AND password='$password'";
    // Verifico si conectó la base de datos
    if (conectarDb()) {
         $idUsuario = "";
         /*
         * Realizo la consulta y almaceno el resultado en la variable $result.- 
         * previamente conectando la base de datos con el metodo conectarDb()
         * luego obtengo el array de resultados y lo recorro con un bucle while.
         * obteniendo cada fila (row).   
         */
         $result = mysql_query($query);
         $row = mysql_fetch_array($result);
        if ($row["id"] != null) {
            $idUsuario = $row["id"];
        }
        $_SESSION["idUser"] = $idUsuario;
        header("Location: ../index.php");
    } else {
        // Si no me puedo conectar con la base da datos, muestro un mensaje de error.
        echo "ERROR: No se conecto la base de datos";
    }
}

/*
 * La funcion verifica si el usuario esta
 * loguado, si el idUser es distinto de ""
 * es por que el usuario esta logueado y retorna
 * verdadero, si no el usuario esta deslogueado 
 * y retorna falso.
 */

function verificarLogin() {
    /*
     * Verifico si la variable de sesison esta definida
     * si esta definida verifico si es igual o distinto de 
     * un caracter en blanco ("").
     */
    if (isset($_SESSION["idUser"])) {
        if ($_SESSION["idUser"] != "") {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Destruye la sesion del usuario y borra todas
 * las variables almacenadas tales como idUser. 
 */
function cerrarSesion() {
    session_destroy();
    header("Location: ../index.php");
}

/**
 * Si no existe la variable de session IdUser quiere decir
 * que nadie esta logueado en la aplicacion y redirecciona 
 * constantemente al inicio, que es la pagina que cualquier 
 * usuario que NO este logueado tiene que ver. 
 */
function segurizar() {
    if (!isset($_SESSION["idUser"])) {
        header("Location: index.php");
    }
}
/**
 * Se obtinen todos los datos del usuario que corresponden al id del
 * anuncio.
 */
function obtenerDatosUsuario($idAnuncio) {
    $queryObtenerUsuario = "SELECT * FROM usuarios AS u JOIN anuncios AS a ON u.id = a.idUser WHERE a.id = $idAnuncio";
    if (conectarDb()) {
        /**
         * Si conecta realizo la consulta con mysq_query 
         */
        $resultado = mysql_query($queryObtenerUsuario);
        /**
         * Retorno los resultado de la consulta
         */
        return $resultado;
    }
}
?>
