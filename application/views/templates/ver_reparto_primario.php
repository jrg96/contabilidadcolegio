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
            
            <div class="panel panel-primary">
                <div class="panel-heading">Distribucion primaria de los costos</div>
                <div class="panel-body">
            
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th rowspan="5"><center>Nombre centro de costo</center></th>
									{foreach item=criterio from=$criterios_aplicados}
									<th colspan="3"><center>Criterio: {$criterio.nombre_criterio}</center></th>
									{/foreach}
									<th rowspan="5"><center>Total</center></th>
                                </tr>
								<tr>
									{foreach item=criterio from=$criterios_aplicados}
									<th colspan="3"><center>{$criterio.cuenta_repartir}</center></th>
									{/foreach}
								</tr>
								<tr>
									{foreach item=criterio from=$criterios_aplicados}
									<th colspan="3"><center>Total unidades: {$criterio.total_unidades}</center></th>
									{/foreach}
								</tr>
								<tr>
									{foreach item=criterio from=$criterios_aplicados}
									<th colspan="3"><center>$ Disponible: {$criterio.dinero_disponible}</center></th>
									{/foreach}
								</tr>
								<tr>
									{foreach item=criterio from=$criterios_aplicados}
									<th><center>Valor unidad</center></th>
									<th><center>Factor</center></th>
									<th><center>$ correspondiente</center></th>
									{/foreach}
								</tr>
                            </thead>
                            <tbody>
                                {foreach item=$centro_costo from=$info_a_desplegar}
								<tr>
									<th><center>{$centro_costo.nombre_centro_costo}</center></th>
									{foreach item=criterio from=$centro_costo.criterios}
									<th><center>{$criterio.valor_unidad}</center></th>
									<th><center>{$criterio.factor}</center></th>
									<th><center>{$criterio.total_correspondiente}</center></th>
									{/foreach}
									<th><center>{$centro_costo.total_consumido}</center></th>
								</tr>
								{/foreach}
                            </tbody>
							<tfoot>
								<tr>
									<th><center>Total: </center></th>
									{foreach item=$total_criterio from=$totales_finales.totales_criterios}
									<th><center>{$total_criterio.valor_unidad}</center></th>
									<th><center>{$total_criterio.factor}</center></th>
									<th><center>{$total_criterio.total_correspondiente}</center></th>
									{/foreach}
									<th><center>{$totales_finales.total_centro_criterio}</center></th>
								</tr>
							</tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="{$base_url}js/bootstrap.min.js"></script>
    </body>
</html>
