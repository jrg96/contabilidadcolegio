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
                <div class="panel-heading">Costos uniatrios inductores de costo</div>
                <div class="panel-body">
            
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
									<th><center>Nombre actividad</center></th>
									<th><center>Costo total</center></th>
									<th><center># inductores de costo</center></th>
									<th><center>C.U inductor</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach item=$actividad from=$info_a_desplegar}
								<tr>
									<th><center>{$actividad.nombre_actividad}</center></th>
									<th><center>{$actividad.costo_total}</center></th>
									<th><center>{$actividad.total_inductores}</center></th>
									<th><center>{$actividad.costo_unitario}</center></th>
								</tr>
								{/foreach}
                            </tbody>
							<tfoot>
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
