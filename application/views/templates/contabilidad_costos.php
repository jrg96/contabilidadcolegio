<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contabilidad de Costos</title>
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
            <div class="starter-template">
                <h1>Acciones a realizar contabilidad de costos</h1>
                
                <div class="panel panel-primary">
                    <div class="panel-heading">Centros de costo</div>
                    <div class="panel-body">
                        <a href="/sic115/index.php/crearcentrocosto/index" class="btn btn-info" role="button">Crear centro de costo</a>
						<a href="/sic115/index.php/listacentroscosto/index" class="btn btn-info" role="button">Ver centros de costo</a>
                    </div>
                </div>
				
				<div class="panel panel-primary">
                    <div class="panel-heading">Criterios de reparto primario</div>
                    <div class="panel-body">
                        <a href="/sic115/index.php/crearcriteriorepartoprimario/index" class="btn btn-info" role="button">Crear criterio reparto primario</a>
						<a href="/sic115/index.php/listacriteriorepartoprimario/index" class="btn btn-info" role="button">Lista criterio reparto primario</a>
						<a href="/sic115/index.php/verrepartoprimario/index" class="btn btn-info" role="button">Ver reparticion criterio reparto primario</a>
                    </div>
                </div>
				
				<div class="panel panel-primary">
                    <div class="panel-heading">Actividades</div>
                    <div class="panel-body">
                        <a href="/sic115/index.php/crearactividad/index" class="btn btn-info" role="button">Crear actividad</a>
						<a href="/sic115/index.php/listaactividades/index" class="btn btn-info" role="button">Ver actividades</a>
                    </div>
                </div>
				
				<div class="panel panel-primary">
                    <div class="panel-heading">Criterios de reparto secundario</div>
                    <div class="panel-body">
						{foreach item=$centro from=$centros_costo}
                        <a href="/sic115/index.php/crearcriteriorepartosecundario/index/{$centro.id_centro_costo}" class="btn btn-info" role="button">Modificar criterio de reparto para {$centro.nombre_centro_costo}</a>
						<br />
						<br />
						{/foreach}
						<br />
						<br />
						<br />
						<a href="/sic115/index.php/listacriteriorepartosecundario/index" class="btn btn-info" role="button">Ver Lista de criterios de reparto secundarios</a>
						<a href="/sic115/index.php/verrepartosecundario/index" class="btn btn-info" role="button">Ver reparto secundario</a>
                    </div>
                </div>
                
				<div class="panel panel-primary">
                    <div class="panel-heading">Criterios de reparto terciarios (Actividades auxiliares)</div>
                    <div class="panel-body">
						{foreach item=$actividad from=$actividades_auxiliares}
                        <a href="/sic115/index.php/crearcriteriorepartoterciario/index/{$actividad.id_actividad}" class="btn btn-info" role="button">Modificar criterio de reparto para {$actividad.nombre_actividad}</a>
						<br />
						<br />
						{/foreach}
						<br />
						<br />
						<br />
						<a href="/sic115/index.php/listacriteriorepartoterciario/index" class="btn btn-info" role="button">Ver Lista de criterios de reparto terciarios</a>
						<a href="/sic115/index.php/verrepartoterciario/index" class="btn btn-info" role="button">Ver reparto terciario</a>
                    </div>
                </div>
				
				<!--
				<div class="panel panel-primary">
                    <div class="panel-heading">Inductores de costo</div>
                    <div class="panel-body">
                        <a href="/sic115/index.php/crearinductorcosto/index" class="btn btn-info" role="button">Asignar nombres a los inductores de costo</a>
						<a href="/sic115/index.php/crearconsumidorcosto/index" class="btn btn-info" role="button">Crear consumidor costo</a>
						<a href="/sic115/index.php/listaconsumidorescosto/index" class="btn btn-info" role="button">Ver consumidores de costo</a>
						<a href="/sic115/index.php/vercostounitarioactividad/index" class="btn btn-info" role="button">Ver costos unitarios inductores de costos</a>
                    </div>
                </div>
				-->
				
            </div>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="{$base_url}js/bootstrap.min.js"></script>
    </body>
</html>