<?php
	
require_once __DIR__ . '/../../Funciones/funciones-anuncios.php';

$resultadoAnuncios = obtenerTodosMisAnuncios();
?>
<table id = "table-mis-anuncios">
	<thead>
		<td><strong>Foto</strong></td>
		<td><strong>Titulo</strong></td>
		<td><strong>Categoria</strong></td>
		<td><strong>Precio</strong></td>
		<td><strong>Acción</strong></td>
	</thead>
	<?php while($anuncio = mysql_fetch_array($resultadoAnuncios)): ?>
	<tr>
		<td><img src="<?php echo $anuncio['urlFoto']; ?>"></td>
		<td><?php echo $anuncio['titulo']; ?></td>
		<td><?php echo $anuncio['categoria']; ?></td>
		<td>$<?php echo $anuncio['precio']; ?></td>
		<td>
			<a href="editar-anuncio.php?idAnuncio=<?php echo $anuncio['id']; ?>">Editar</a>
			| 
			<a href ="Formularios/eliminar-anuncio.php?idAnuncio=<?php echo $anuncio['id']; ?>">Eliminar</a>
		</td>
	</tr>
	<?php endwhile; ?>
</table>