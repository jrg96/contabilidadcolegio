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
            
            <form action="/sic115/index.php/modificarcentrocosto/procesar" method="POST">
				<input type="hidden" name="id_centro_costo" id="id_centro_costo" value="{$centro_costo.id_centro_costo}" />
                <div class="panel panel-primary">
                    <div class="panel-heading">Modificar centro de costo</div>
                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label for="id_cuenta">Nombre del centro de costo:</label>
                            <input type="text" class="form-control" id="nombre_centro_costo" name="nombre_centro_costo" value="{$centro_costo.nombre_centro_costo}">
                        </div>
                    
                        <div class="form-group">
                            <label for="usr">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion_centro_costo" name="descripcion_centro_costo" value="{$centro_costo.descripcion_centro_costo}">
                        </div>
                        
                        <button type="submit" class="btn btn-success">Modificar centro costo</input>
                    </div>
                </div>
            </form>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="{$base_url}js/bootstrap.min.js"></script>
    </body>
</html>
