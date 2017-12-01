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
			
			<form action="/sic115/index.php/verestadosfinancieros/procesarconsulta" method="POST">
			<input type="hidden" name="id_cuenta" id="id_cuenta" value="{$cuenta.id_cuenta_interno}">
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
                <div class="panel-heading">Balance de comprobacion con ajustes</div>
                <div class="panel-body">
                
                
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th rowspan="2"><center>nombre de cuenta</center></th>
                                    <th colspan="2"><center>Valores sin ajuste</center></th>
                                    <th colspan="2"><center>Ajustes</center></th>
                                    <th colspan="2"><center>Valores ajustados</center></th>
                                </tr>
                                <tr>
                                    <th><center>Debe</center></th>
                                    <th><center>Haber</center></th>
                                    <th><center>Debe</center></th>
                                    <th><center>Haber</center></th>
                                    <th><center>Debe</center></th>
                                    <th><center>Haber</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                {foreach item=fila from=$datos_a_desplegar}
                                <tr>
                                    <th><center>{$fila.nombre}</center></th>
                                    <th><center>{$fila.debe_no_ajuste}</center></th>
                                    <th><center>{$fila.haber_no_ajuste}</center></th>
                                    <th><center>{$fila.debe_ajuste}</center></th>
                                    <th><center>{$fila.haber_ajuste}</center></th>
                                    <th><center>{$fila.debe_todo}</center></th>
                                    <th><center>{$fila.haber_todo}</center></th>
                                </tr>
                                {/foreach}
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total</center></th>
                                    <th><center>{$saldo_debe_no_ajuste}</center></th>
                                    <th><center>{$saldo_haber_no_ajuste}</center></th>
                                    <th><center>{$saldo_debe_ajuste}</center></th>
                                    <th><center>{$saldo_haber_ajuste}</center></th>
                                    <th><center>{$saldo_debe_todo}</center></th>
                                    <th><center>{$saldo_haber_todo}</center></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Estado de resultado</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>Nombre de cuenta</center></th>
                                    <th><center>Debe</center></th>
                                    <th><center>Haber</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                {foreach item=fila from=$datos_resultado_a_desplegar}
                                <tr>
                                    <th><center>{$fila.nombre}</center></th>
                                    <th><center>{$fila.debe}</center></th>
                                    <th><center>{$fila.haber}</center></th>
                                </tr>
                                {/foreach}
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total</center></th>
                                    <th><center>{$saldo_debe_resultado}</center></th>
                                    <th><center>{$saldo_haber_resultado}</center></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <h4>Estado: {$mensaje_estado_empresa}</h4>
                </div>
            </div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Estado de capital</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>Nombre de la cuenta</center></th>
                                    <th><center>Desinversion</center></th>
                                    <th><center>Inversion</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                {foreach item=fila from=$datos_capital_a_desplegar}
                                <tr>
                                    <th><center>{$fila.nombre}</center></th>
                                    <th><center>{$fila.debe}</center></th>
                                    <th><center>{$fila.haber}</center></th>
                                </tr>
                                {/foreach}
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total (Capital contable)</center></th>
                                    <th><center>{$saldo_debe_capital}</center></th>
                                    <th><center>{$saldo_haber_capital}</center></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Balance general</div>
                <div class="panel-body">
                    <h4>Ya que se presentaron ganancias, la utilidad retenida es del 40%</h4>
                    <br />
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>Nombre de la cuenta</center></th>
                                    <th><center>Desinversion</center></th>
                                    <th><center>Inversion</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                {foreach item=fila from=$datos_balancegeneral_a_desplegar}
                                <tr>
                                    <th><center>{$fila.nombre}</center></th>
                                    <th><center>{$fila.debe}</center></th>
                                    <th><center>{$fila.haber}</center></th>
                                </tr>
                                {/foreach}
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total</center></th>
                                    <th><center>{$saldo_debe_balance_general}</center></th>
                                    <th><center>{$saldo_haber_balance_general}</center></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

			<form action="/sic115/index.php/verestadosfinancieros/procesar" method="POST">
			<div class="panel panel-primary">
                <div class="panel-heading">Cerrar periodo contable</div>
                <div class="panel-body">
					<h4> Precaución: despues de cerrado el periodo contable no puede volver a abrirse </h4>
					<br />
					<p><b>Inicio del siguient periodo contable: {$fecha_nuevo_periodo}</b></p>
					<br />
					<button type="submit" class="btn btn-success">Cerrar periodo contable</input>
                </div>
            </div>
			</form>
			
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="{$base_url}js/bootstrap.min.js"></script>
    </body>
</html>