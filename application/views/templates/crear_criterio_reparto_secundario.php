<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crear cuenta</title>
        <link href="{$base_url}css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">SIC-115</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/sic115/index.php/paginas/index">Inicio</a></li>
                        <li><a href="/sic115/index.php/paginas/contabilidadgeneral">Contabilidad General</a></li>
                        <li><a href="/sic115/index.php/contabilidadcostos/index">Contabilidad de costos</a></li>
						<li><a href="/sic115/index.php/logout/index">Cerrar sesion</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">
            <br />
            <br />
            <br />
            
            {if $resultado_operacion neq 'ninguna'}
            <div class="alert alert-success">
                <strong>{$resultado_operacion}</strong> {$mensaje_operacion}
            </div>
            {/if}
            
			{if $es_nuevo_registro eq 'si'}
            <form action="/sic115/index.php/crearcriteriorepartosecundario/procesarinsertar" method="POST">
			{else}
			<form action="/sic115/index.php/crearcriteriorepartosecundario/procesarmodificar" method="POST">
			{/if}
				<input type="hidden" name="id_centro_costo" id="id_centro_costo" value="{$centro_costo.id_centro_costo}" />
				<input type="hidden" name="es_nuevo_registro" id="es_nuevo_registro" value="{$es_nuevo_registro}" />
				<input type="hidden" name="id_criterio_reparto_secundario" id="id_criterio_reparto_secundario" value="{$criterio_reparto_secundario.id_criterio_reparto_secundario}" />
                <div class="panel panel-primary">
                    <div class="panel-heading">Crear criterio de reparto secundario para {$centro_costo.nombre_centro_costo}</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="usr">Nombre de criterio de reparto secundario:</label>
                            <input type="text" class="form-control" id="nombre_criterio_reparto_secundario" name="nombre_criterio_reparto_secundario" value="{$criterio_reparto_secundario.nombre_criterio_reparto_secundario}">
                        </div>
						
						<div class="form-group">
                            <label for="usr">Descripcion de criterio de reparto secundario:</label>
                            <input type="text" class="form-control" id="desc_criterio_reparto_primario" name="desc_criterio_reparto_secundario" value="{$criterio_reparto_secundario.desc_criterio_reparto_secundario}">
                        </div>
						
						<div class="form-group">
                            <label for="usr">Unidad en la que estarán expresados los valores:</label>
                            <input type="text" class="form-control" id="unidad_reparto" name="unidad_reparto" value="{$criterio_reparto_secundario.unidad_reparto}">
                        </div>
                    </div>
                </div>
				
				<div class="panel panel-primary">
					<div class="panel-heading">Valores para las actividades</div>
					<div class="panel-body">
						{foreach item=$actividad from=$actividades}
						<div class="form-group">
                            <label for="usr">Valor para {$actividad.nombre_actividad}:</label>
							{if $es_nuevo_registro eq 'si'}
                            <input type="text" class="form-control" id="actividad_{$actividad.id_actividad}" name="actividad_{$actividad.id_actividad}">
							{else}
							<input type="text" class="form-control" id="unidad_reparto_{$actividad.id_unidad_reparto_secundario}" name="unidad_reparto_{$actividad.id_unidad_reparto_secundario}" value="{$actividad.valor_unidad}">
							{/if}
                        </div>
						{/foreach}
						<button type="submit" class="btn btn-success">Crear criterio de reparto primario</input>
					</div>
				</div>
            </form>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="{$base_url}js/bootstrap.min.js"></script>
    </body>
</html>
