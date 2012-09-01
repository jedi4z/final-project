<?php
/**
 * Este arhivo contiene el 'fragmento de vista' que representa
 * el panel para crear un nuevo usuario y el de logueo, si el usuario no esta
 * logueado o el panel del usuario si el usuario esta logueado
 * 
 * @package Snippets
 * @name ultimos-anuncios.php
 * @author Jesús Díaz
 * @copyright Agilecode
 */
/**
 * Incluyo las funciones-usuarios.php en donde hago uso de la funcion
 * verificarLogin() y de acuerdo al resultado de la funcion muestro
 * uno u otro panel.
 *  
 */
require_once __DIR__ . '/../../Funciones/funciones-usuario.php';
/**
 * Si el estado de la variable de sesion
 * es igual a null, es por que no esta logueado
 * el usuario, si es distinta de null, es por 
 * que hay un usuario logueado y muestro el panel
 * con las opciones de usuario. 
 */
?>
<?php if (verificarLogin()): ?>
    <div id="containter-box">
        <div id="title-box">Panel del usuario</div>
        <ul>
            <li><img src ="Images/Inicio/inicio.gif" /><a href="index.php">Inicio</a></li>
            <li><img src ="Images/Inicio/publicar.gif" /><a href="nuevo-anuncio.php">Publicar anuncio</a></li>
            <li><img src="Images/Inicio/mis-anuncios.png"><a href="mis-anuncios.php">Mis anuncios</a></li>
            <li><img src ="Images/Inicio/favorito.jpg" /><a href="">Favoritos</a></li>
            <li><img src ="Images/Inicio/pregunta.png" /><a href="">Mis preguntas</a></li>
            <hr>
            <li><img src ="Images/Inicio/salir.gif" /><a href="Formularios/cerrar-sesion.php">Salir</a></li>
        </ul>         
    </div>    
<?php else: ?>
    <div id="containter-box">
        <div id="title-box">Entrar</div>
        <form action="Formularios/iniciar-sesion.php" method="post">
            <input type="text" name="usuario" placeholder="Usuario" required="required" />
            <br>
            <input type="password" name="password" placeholder="Password" required="required" />
            <br>
            <input type="submit" value="Ingresar!"/>
        </form>
    </div>
    <div id="containter-box">
        <div id="title-box">Crear una cuenta</div>
        <form action="Formularios/registrar-usuario.php" method="post">
            <input type="text" name="nombres" placeholder="Nombres" required="required"/>
            <br>
            <input type="text" name="apellidos" placeholder="Apellidos" required="required"/>
            <br>
            <input type="date" name="fechaNacimiento" placeholder="01/01/2000" required="required"/>
            <br>
            <input type="email" name="email" placeholder="E-mail" required="required"/>
            <br>
            <input type="password" name="password" placeholder="Password" required="required"/>
            <br>
            <input type="password" name="repPassword" placeholder="Repetir password" required="required"/>
            <br>
            <input type="submit" value="Registrarme!"/>
        </form>          
    </div>
<?php endif; ?>
