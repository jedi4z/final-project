<?php
/**
 * Este arhivo contiene el 'fragmento de vista' que representa
 * los ultimos anuncios publicados en la aplicacion. 
 * 
 * @package Snippets
 * @name ultimos-anuncios.php
 * @author Jesús Díaz
 * @copyright Agilecode
 */
/**
 * Incluyo las funciones-anuncios.php en donde hago uso de la funcion
 * listarAnuncios() y muestro los ultimos anuncios publicados.
 *  
 */
require_once __DIR__ . '/../../Funciones/funciones-anuncios.php';

$anuncios = listarAnuncios();
?>
<?php while ($fila = mysql_fetch_array($anuncios)): ?>
    <div class="wrapper-anuncio">
        <a href="ver-anuncio.php?idAnuncio=<?php echo $fila['id'] ?>">
            <img src="<?php echo $fila['urlFoto']; ?>" />
            <div class="titulo-anuncio"><?php echo $fila['titulo'] ?></div>
        </a>
        <div class="precio-anuncio">$<?php echo $fila['precio'] ?></div>
    </div>
<?php endwhile; ?>
