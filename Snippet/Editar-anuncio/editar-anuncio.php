<?php 

require_once __DIR__ . '/../../Funciones/funciones-anuncios.php';
/**
 * Se obtiene el numero de id de anuncio
 * a traves de la variable get enviada por 
 * url.
 */
$idAnuncio = $_GET['idAnuncio'];
/**
 * Obtengo los datos del anuncio y lo guardo en $anuncio.
 */
$resultadoAnunciosAutenticado = obtenerDatosAnuncioAutenticado($idAnuncio);
$anuncio                      = mysql_fetch_array($resultadoAnunciosAutenticado);
?>
<div id="title-box">Editar anuncio "<?php echo $anuncio['titulo'] ?>"</div>
<h5>Edite el anuncio que ya publico para atraer a mas posibles compradores</h5>
<form action="Formularios/editar-anuncio.php" method="POST">
    <h5>Foto del articulo</h5>
    <hr>
    <input type="text" name="urlFoto" value="<?php echo $anuncio['urlFoto'] ?>" required="required" size="90" />
    <h5>Titulo del articulo</h5>
    <hr>
    <input type="text" name="titulo" value="<?php echo $anuncio['titulo'] ?>" required="required" size="90" />
    <h5>Categoria</h5>
    <hr>
    <select name="categoria">
        <option value ="<?php echo $anuncio['categoria'] ?>" selected="selected"><?php echo $anuncio['categoria'] ?></option>
        <option value ="Adultos">Adultos</option>
        <option value ="Animales y mascotas">Animales y Mascotas</option>
        <option value ="Arte y antiguedades">Arte y Antiguadades</option>
        <option value ="Autos">Autos</option>
        <option value ="Celulares">Celulares</option>
        <option value ="Fotografia">Fotografia</option>
        <option value ="Inmuebles">Inmuebles</option>
    </select>
    <h5>Precio</h5>
    <hr>
    <input type="text" name="precio" value="<?php echo $anuncio['precio'] ?>" required="required" size="90" />
    <h5>Descripcion del articulo</h5>
    <hr>
    <textarea rows="7" cols="70" name="descripcion" required="required"><?php echo $anuncio['descripcion'] ?></textarea>
    <h5>6- Publique el anuncio, y listo!</h5>
    <hr>
    <!-- Aqui utilizo un campo oculto para poder enviar el -->
    <!-- id del anuncio al archivo que recibe los datos del formulario -->
    <input type="hidden" value="<?php echo $idAnuncio; ?>" name="idAnuncio">
    <input type="submit" value="Guardar cambios!"/>
</form>