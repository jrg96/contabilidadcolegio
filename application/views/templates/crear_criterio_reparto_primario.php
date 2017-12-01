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
            
            <form action="/sic115/index.php/crearcriteriorepartoprimario/procesar" method="POST">
                <div class="panel panel-primary">
                    <div class="panel-heading">Crear criterio de reparto primario</div>
                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label for="id_cuenta">La cuenta a repartir es:</label>
                            <select class="form-control" id="cuenta_a_repartir" name="cuenta_a_repartir">
                            {foreach item=cuenta from=$cuentas}
                                <option value="{$cuenta.id_cuenta_interno}">{$cuenta.id_clase_cuenta}.{$cuenta.id_grupo_cuenta}.{$cuenta.id_cuenta_mayor}.{$cuenta.id_cuenta} {$cuenta.nombre_cuenta} {$cuenta.abreviatura_clase_cuenta}</option>
                            {/foreach}
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="usr">Nombre de criterio de reparto primario:</label>
                            <input type="text" class="form-control" id="nombre_criterio_reparto_primario" name="nombre_criterio_reparto_primario">
                        </div>
						
						<div class="form-group">
                            <label for="usr">Descripcion de criterio de reparto primario:</label>
                            <input type="text" class="form-control" id="desc_criterio_reparto_primario" name="desc_criterio_reparto_primario">
                        </div>
						
						<div class="form-group">
                            <label for="usr">Unidad en la que estarán expresados los valores:</label>
                            <input type="text" class="form-control" id="unidad_reparto" name="unidad_reparto">
                        </div>
                    </div>
                </div>
				
				<div class="panel panel-primary">
					<div class="panel-heading">Valores para los centros de costo</div>
					<div class="panel-body">
						{foreach item=centro from=$centros_costo}
						<div class="form-group">
                            <label for="usr">Valor para {$centro.nombre_centro_costo}:</label>
                            <input type="text" class="form-control" id="centro_costo_{$centro.id_centro_costo}" name="centro_costo_{$centro.id_centro_costo}">
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
