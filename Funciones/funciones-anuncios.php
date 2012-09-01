<?php

/**
 * Este archivo contiene todas las funciones que referencian a los 
 * comportamientos del usuario, ejemplo; crear un usuario, modificar
 * los datos del usuario etc.
 * 
 * @package Funciones
 * @name funciones-anuncios.php
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
 * Se recibe todos los parametros necesarios para realizar el alta
 * del nuevo anuncio, luego se redirecciona a la pagina de inicio.
 * 
 * @param type $urlFoto
 * @param type $titulo
 * @param type $precio
 * @param type $categoria
 * @param type $descripcion 
 */
function cargarAnuncio($urlFoto, $titulo, $precio, $categoria, $descripcion) {
    $idUser = $_SESSION["idUser"];
    $queryCargarNuevoAnuncio = "INSERT INTO anuncios (urlFoto, titulo, precio, categoria, descripcion, idUser) VALUES ('$urlFoto', '$titulo', '$precio', '$categoria', '$descripcion', '$idUser')";
    /**
     * Verifico si el usuario completo todos los datos del formulario 
     * desde el servidor. 
     */
    if ($urlFoto != null && $titulo != null && $categoria != null && $precio != null && $descripcion != null) {
        /**
         *  Verifico si conectó la base de datos
         */
        if (conectarDb()) {
            mysql_query($queryCargarNuevoAnuncio);
            header("Location: ../index.php");
        } else {
            /**
             *  Si no me puedo conectar con la base da datos, muestro un mensaje de error.
             */
            echo "ERROR: No se conecto la base de datos";
        }
    } else {
        /**
         * Si el usuario no llena todo el formulario, se le indica al usuario, y que vuelva a llenar
         * los campos. 
         */
        echo "ERROR: Por favor complete todos los datos del formulario para cargar el anuncio";
    }
}

/**
 * La funcion consulta todos los anuncios de la base de datos,
 * si hay retorna el resultado de la consulta.
 * 
 * @return boolean 
 */
function listarAnuncios() {
    /**
     * Creamos la cadena que con tiene la consulta a la base de datos, en la cual
     * solicitamos todos los anuncios ordenados de mayor a menor por id.
     * ya que el id de cada articulo es unico e incremental, los articulos que 
     * tengan el id mas alto son los ultimos ingresados a la base de datos. 
     */
    $queryListarAnuncios = "SELECT * FROM anuncios ORDER BY id DESC";
    /**
     * Verifico si conecta la base de datos. 
     */
    if (conectarDb()) {
        /**
         * Si conecta realizo la consulta con mysq_query 
         */
        $resultado = mysql_query($queryListarAnuncios);
        /**
         * Retorno los resultado de la consulta
         */
        return $resultado;
    }
}

/**
 * La funcion obtiene los datos del anuncio segun el id del mismo.
 * y devuelve el resultado de la busqueda.
 */
function obtenerDatosAnuncio($idAnuncio) {

    $queryObtenerAnuncio = "SELECT * from anuncios WHERE id = $idAnuncio";

    if (conectarDb()) {
        /**
         * Si conecta realizo la consulta con mysq_query 
         */
        $resultado = mysql_query($queryObtenerAnuncio);
        /**
         * Retorno los resultado de la consulta
         */
        return $resultado;
    }
}

/**
 * La funcion obtiene los datos del anuncio, siempre y cuando correspondan 
 * al usuario que esta logueado.
 */
function obtenerDatosAnuncioAutenticado($idAnuncio){
    $idUser = $_SESSION["idUser"];
    $queryObtenerDatosAnuncioAutenticado = "SELECT * FROM anuncios AS a JOIN usuarios AS u ON a.idUser = u.id "
                                           ."WHERE a.id = $idAnuncio AND a.idUser = $idUser";

    if (conectarDb()) {
        /**
         * Si conecta realizo la consulta con mysq_query 
         */
        $resultado = mysql_query($queryObtenerDatosAnuncioAutenticado);
        /**
         * Retorno los resultado de la consulta
         */
        return $resultado;
    }
}

/**
 * La funcion verifica si el articulo a editar es del usuario que esta lomgueado
 * si no es asi redirecciona la pagina al inicio.
 */
function segurizarAnuncio ($idAnuncio){
    /**
     * Creo la cadena que consulta el id del usuario siempre y cuando el id del anuncio
     * sea igual al id ingresado por parametro.
     */
    $query = "SELECT u.id FROM usuarios AS u JOIN anuncios AS a ON u.id = a.idUser WHERE a.id = $idAnuncio";
    if (conectarDb()) {
        /**
         * Si conecta realizo la consulta con mysq_query 
         */
        $resultado = mysql_query($query);
        $idUser        = mysql_fetch_array($resultado);
        /**
         * Si el id devuelto es distinto al del usuario logueado
         * redirecciono la pagina a el index.php
         */
        if ($idUser['id'] != $_SESSION["idUser"]){
            header("Location: index.php");
        }
    }    
}

/**
 * La funcion actualiza la informacion de un anuncio en particular,
 * segun el idAnuncio enviado por parametro y los datos a modificar.
 */
function editarAnuncio ($idAnuncio, $urlFoto, $titulo, $categoria, $precio, $descripcion){
    /**
     * Creo la cadena que actualiza los nuevos datos con la instruccion
     * UPDATE
     */
    $queryActualizarAnuncio = "UPDATE anuncios SET urlFoto = '$urlFoto', titulo = '$titulo', ".
                              "categoria = '$categoria', precio = '$precio', descripcion = '$descripcion' ".
                              "WHERE id = '$idAnuncio'";
    if (conectarDb()) {
        /**
         * Si conecta realizo la consulta con mysq_query 
         */
        $resultado = mysql_query($queryActualizarAnuncio);
        $idUser    = mysql_fetch_array($queryActualizarAnuncio);
        /**
         * Luego de realizar la modificacion redirecciono la pagina
         * a la pagina del producto.
         */
        header("Location: ../ver-anuncio.php?idAnuncio=$idAnuncio");        
    }   
}   
/**
 * La funcion busca en la base de datos todos los anuncios del usuario
 * que esta actualmente logueado comparano el idUser del anuncio con el
 * idUser de l variable en sesion.
 */
function obtenerTodosMisAnuncios(){
    $idUser = $_SESSION["idUser"];
    $queryObtenerTodosMisAnuncios = "SELECT a.id, a.titulo, a.precio, a.urlFoto, a.descripcion, a.categoria ".
                                    "FROM anuncios AS a JOIN usuarios AS u ON a.idUser = u.id WHERE a.idUser = $idUser";

    if (conectarDb()) {
        /**
         * Si conecta realizo la consulta con mysq_query 
         */
        $resultado = mysql_query($queryObtenerTodosMisAnuncios);
        /**
         * Retorno los resultado de la consulta
         */
        return $resultado;
    }
}

/**
 * La funcion elimina el anuncio segun el idAnuncio enviado por paramatro
 */
function eliminarAnuncio($idAnuncio){

    $queryEliminarAnuncio = "DELETE FROM anuncios WHERE id = '$idAnuncio' ";
    if (conectarDb()) {
        /**
         * Si conecta realizo la consulta con mysq_query 
         */
        $resultado = mysql_query($queryEliminarAnuncio);
        /**
         * Luego de eliminar el anuncio, redirecciono la pagina
         * a la pagina "mis-anunucios.php".
         */
        header("Location: ../mis-anuncios.php");  
    }
}

?>
