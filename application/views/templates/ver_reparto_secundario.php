<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Starter Template for Bootstrap</title>
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
            
			{foreach item=$centro_costo from=$info_a_desplegar}
			<div class="panel panel-primary">
                <div class="panel-heading">Distribucion secundaria para el centro de costo: {$centro_costo.nombre_centro_costo}</div>
                <div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th rowspan="4"><center>Nombre actividad</center></th>
									<th colspan="3"><center>{$centro_costo.nombre_criterio_reparto}</center></th>
								</tr>
								<tr>
									<th colspan="3"><center>Dinero disponible: {$centro_costo.dinero_disponible}</center></th>
								</tr>
								<tr>
									<th colspan="3"><center>Total unidades: {$centro_costo.total_unidades}</center></th>
								</tr>
								<tr>
									<th><center>Unidades</center></th>
									<th><center>Factor</center></th>
									<th><center>$ correspondiente</center></th>
								</tr>
							</thead>
							<tbody>
								{foreach item=$actividad from=$centro_costo.actividades}
								<tr>
									<th><center>{$actividad.nombre_actividad}</center></th>
									<th><center>{$actividad.valor_unidad}</center></th>
									<th><center>{$actividad.factor}</center></th>
									<th><center>{$actividad.dinero_correspondiente}</center></th>
								</tr>
								{/foreach}
							</tbody>
							<tfoot>
								<tr>
									<th><center>Total: </center></th>
									<th><center>{$centro_costo.unidades_contado}</center></th>
									<th><center>{$centro_costo.factor_contado}</center></th>
									<th><center>{$centro_costo.dinero_contado}</center></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			{/foreach}
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="{$base_url}js/bootstrap.min.js"></script>
    </body>
</html>
