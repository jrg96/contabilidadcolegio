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
            <form action="/sic115/index.php/crearinductorcosto/procesarinsertar" method="POST">
			{else}
			<form action="/sic115/index.php/crearinductorcosto/procesarmodificar" method="POST">
			{/if}
				<input type="hidden" name="es_nuevo_registro" id="es_nuevo_registro" value="{$es_nuevo_registro}" />
				
				<div class="panel panel-primary">
					<div class="panel-heading">Inductores para las actividades</div>
					<div class="panel-body">
						{foreach item=$actividad from=$actividades}
						<div class="form-group">
                            <label for="usr">Valor para {$actividad.nombre_actividad}:</label>
							{if $es_nuevo_registro eq 'si'}
                            <input type="text" class="form-control" id="actividad_{$actividad.id_actividad}" name="actividad_{$actividad.id_actividad}">
							{else}
							<input type="text" class="form-control" id="inductor_{$actividad.id_inductor_costo}" name="inductor_{$actividad.id_inductor_costo}" value="{$actividad.nombre_inductor_costo}">
							{/if}
                        </div>
						{/foreach}
						<button type="submit" class="btn btn-success">Crear inductores de costo</input>
					</div>
				</div>
            </form>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="{$base_url}js/bootstrap.min.js"></script>
    </body>
</html>
