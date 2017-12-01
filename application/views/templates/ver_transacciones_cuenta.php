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
            
			<form action="/sic115/index.php/vertransaccionescuenta/procesarconsulta" method="POST">
			<div class="panel panel-primary">
                <div class="panel-heading">Periodo contable a consultar</div>
                <div class="panel-body">
					<label for="usr">Periodo contable:</label>
					<select class="form-control" id="id_periodo_contable" name="id_periodo_contable">
					{foreach item=$periodo from=$periodos}
						<option value="{$periodo.id_periodo_contable}">desde: {$periodo.fecha_inicio} - hasta: {$periodo.fecha_final}</option>
					{/foreach}
					</select>
					
					<div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-success">Buscar</button>
                        </div>
                    </div>
				</div>
			</div>
			</form>
			
            <div class="panel panel-primary">
                <div class="panel-heading">Estado de cuenta {$cuenta.nombre_cuenta}</div>
                <div class="panel-body">
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center></center></th>
                                    <th><center>Debe</center></th>
                                    <th><center>Haber</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                {foreach item=transaccion from=$transacciones_desplegar}
                                {if $transaccion.esta_en_debe eq 'V'}
                                <tr>
                                    <th><center>-</center></th>
                                    <th><center>{$transaccion.monto}</center></th>
                                    <th><center>-</center></th>
                                </tr>
                                {else}
                                <tr>
                                    <th><center>-</center></th>
                                    <th><center>-</center></th>
                                    <th><center>{$transaccion.monto}</center></th>
                                </tr>
                                {/if}
                                {/foreach}
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total</center></th>
                                    {if $saldo_debe > -1}
                                    <th><center>{$saldo_debe}</center></th>
                                    <th><center>-</center></th>
                                    {else}
                                    <th><center>-</center></th>
                                    <th><center>{$saldo_haber}</center></th>
                                    {/if}
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