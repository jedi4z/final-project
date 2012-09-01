<?php
/**
 * Aqui se representa una formulario para que se carguen todos los datos para 
 * dar de alta un nuevo anuncio.
 */
?>
<div id="title-box">Publicar un nuevo anuncio</div>
<h5>En Notiexpress podra publicar un anuncio en tan solo 6 sencillos pasos.</h5>
<form action="Formularios/cargar-anuncio.php" method="POST">
    <h5>1- Suba la foto del anuncio</h5>
    <hr>
    <input type="text" name="urlFoto" placeholder="Url de la imagen" required="required" size="90" />
    <h5>2- Eliga el titulo del anuncio</h5>
    <hr>
    <input type="text" name="titulo" placeholder="Titulo del anuncio" required="required" size="90" />
    <h5>3- Seleccione una categoria</h5>
    <hr>
    <select name="categoria">
        <option>Eliga una cateforia</option>
        <option value ="Adultos">Adultos</option>
        <option value ="Animales y mascotas">Animales y Mascotas</option>
        <option value ="Arte y antiguedades">Arte y Antiguadades</option>
        <option value ="Autos">Autos</option>
        <option value ="Celulares">Celulares</option>
        <option value ="Fotografia">Fotografia</option>
        <option value ="Inmuebles">Inmuebles</option>
    </select>
    <h5>4- Establesca un precio</h5>
    <hr>
    <input type="text" name="precio" placeholder="Precio del anuncio" required="required" size="90" />
    <h5>5- Redacte una breve descripcion del anuncio</h5>
    <hr>
    <textarea rows="7" cols="70" name="descripcion" placeholder="Ingrese una breve descripción" required="required"></textarea>
    <h5>6- Publique el anuncio, y listo!</h5>
    <hr>
    <input type="submit" value="Publicar anuncio!"/>
</form>