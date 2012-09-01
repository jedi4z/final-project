<?php
/**
 * Este arhivo contiene el 'fragmento de vista' que representa
 * los ultimos anuncios publicados en la pagina 
 * 
 * @package Snippets
 * @name ultimos-anuncios.php
 * @author Jesús Díaz
 * @copyright Agilecode
 */
/**
 * Incluyo las funciones-anuncios.php en donde hago uso de la funcion
 * obtenerDatosAnuncio($idAnuncio) y muestro los ultimos anuncios publicados.
 * Tambien se incluye funciones-usuario.php para hacer uso de la funcion
 * obtenerDatosUsuario($idAnuncio)
 */
require_once __DIR__ . '/../../Funciones/funciones-anuncios.php';
require_once __DIR__ . '/../../Funciones/funciones-usuario.php';
/**
 * Se obtiene el numero de id de anuncio
 * a traves de la variable get enviada por 
 * url.
 */
$idAnuncio = $_GET['idAnuncio'];
/**
 * Obtengo los datos del anuncio y lo guardo en $anuncio.
 */
$resultadoAnuncios = obtenerDatosAnuncio($idAnuncio);
$anuncio = mysql_fetch_array($resultadoAnuncios);
/**
 * Obtengo los datos del usuario y lo guardo en $usuario.
 */
$resultadoUsuario = obtenerDatosUsuario($idAnuncio);
$usuario = mysql_fetch_array($resultadoUsuario);
/**
 * Muestro en una tabla los datos del anuncio
 * junto con los datos del vendedor (usuario)
 * que publico el articulo.
 */
?>

<div id = "containter-box">
    <div id = "title-box"><?php echo $anuncio['titulo']; ?></div>
    <div id = "wrapper-photo">
        <img src="<?php echo $anuncio['urlFoto']; ?>" />
    </div>
    <div id = "wrapper-data">
        <h5>Datos del articulo</h5>
        <table>
            <tr>
                <td>Titulo:</td>
                <td><?php echo $anuncio['titulo']; ?></td>
            </tr>
            <tr>
                <td>Categoria:</td>
                <td><?php echo $anuncio['categoria']; ?></td>
            </tr>
            <tr>
                <td>Precio:</td>
                <td>$<?php echo $anuncio['precio']; ?></td>
            </tr>
        </table>
        <hr>
        <h5>Datos del vendedor</h5>
        <table>
            <tr>
                <td>Nombres:</td>
                <td><?php echo $usuario['nombres']; ?></td>
            </tr>
            <tr>
                <td>Apellidos:</td>
                <td><?php echo $usuario['apellidos']; ?></td>
            </tr>
            <tr>
                <td>E-mail:</td>
                <td><?php echo $usuario['email']; ?></td>
            </tr>
            <?php 
            /**
             * Aqui se pregunta si el id del vendedor es igual al id
             * del usuario logueado, si es asi, mestra el boton para
             * que el articulo sea editado.
             */
            if ($anuncio['idUser'] == $_SESSION["idUser"] ): 
            ?>
                <tr>
                    <td>Editar anuncio:</td>
                    <td><a href="editar-anuncio.php?idAnuncio=<?php echo $anuncio['id'] ?>">Editar</a></td>
                </tr>
            <?php endif; ?>
        </table>
        <hr>
    </div>
    <div id = "wrapper-description">
        <h5>Descripcion del articulo</h5>
        <hr>
        <?php echo $anuncio['descripcion'] ?>
    </div>
</div>

