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
            
            <form action="/sic115/index.php/modificarempleado/procesar" method="POST">
				<input type="hidden" name="id_empleado" id="id_empleado" value="{$empleado.id_empleado}" />
                <div class="panel panel-primary">
                    <div class="panel-heading">Modificar empleado</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="usr">Nombre del empleado:</label>
                            <input type="text" class="form-control" id="nombre_empleado" name="nombre_empleado" value="{$empleado.nombre_empleado}">
                        </div>
						
						<div class="form-group">
                            <label for="usr">Fecha de contratacion:</label>
                            <input type="text" class="form-control" id="fecha_contratacion" name="fecha_contratacion" value="{$empleado.fecha_contratacion}">
                        </div>
						
						<div class="form-group">
                            <label for="id_cuenta">Salario nominal diario:</label>
							<input type="text" class="form-control" id="salario_base_diario" name="salario_base_diario" value="{$empleado.salario_base_diario}">
                        </div>
						
						<div class="form-group">
                            <label for="id_cuenta">Tipo empleado:</label>
							<input type="text" class="form-control" id="tipo_empleado" name="tipo_empleado" value="{$empleado.tipo_empleado}">
                        </div>
						
						<button type="submit" class="btn btn-success">Modificar empleado</input>
                    </div>
                </div>
            </form>
			
			<div class="panel panel-primary">
                <div class="panel-heading">Salario real</div>
                <div class="panel-body">
					<div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>Prestacion</center></th>
                                    <th><center>Valor</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
								<tr>
									<th><center>Dias de aguinaldo: </center></th>
									<th><center>{$dias_aguinaldo}</center></th>
								</tr>
								<tr>
									<th><center>Aguinaldo semanal: </center></th>
									<th><center>{$aguinaldo_semanal}</center></th>
								</tr>
								<tr>
									<th><center>Vacaciones semanal (15 dias + 30% recargo): </center></th>
									<th><center>{$vacaciones_semanal}</center></th>
								</tr>
								<tr>
									<th><center>Seguro (6.75%) AFP(7.5%) pagado en vacaciones: </center></th>
									<th><center>{$seguro_afp_vacaciones}</center></th>
								</tr>
								<tr>
									<th><center>INSAFORP (1%): </center></th>
									<th><center>{$insaforp_semanal}</center></th>
								</tr>
								<tr>
									<th><center>Seguro (6.75%) AFP(7.5%) pagado semanalmente: </center></th>
									<th><center>{$seguro_afp_semanal}</center></th>
								</tr>
								<tr>
									<th><center>Costo real semanalmente: </center></th>
									<th><center>{$salario_real_semanal}</center></th>
								</tr>
								<tr>
									<th><center>Costo real mensual: </center></th>
									<th><center>{$salario_real_mensual}</center></th>
								</tr>
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
			
			<form action="/sic115/index.php/modificarempleado/procesarpago" method="POST">
			<input type="hidden" name="id_empleado" id="id_empleado" value="{$empleado.id_empleado}" />
			<div class="panel panel-primary">
                <div class="panel-heading">Realizar pago</div>
                <div class="panel-body">
				
					<div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="usr">Cuenta inicial:</label>
                                <select class="form-control" id="cuenta_izquierda" name="cuenta_izquierda">
                                {foreach item=cuenta from=$cuentas}
                                    <option value="{$cuenta.id_cuenta_interno},{$cuenta.id_clase_cuenta},{$cuenta.id_grupo_cuenta},{$cuenta.id_cuenta_mayor},{$cuenta.id_cuenta}">{$cuenta.id_clase_cuenta}.{$cuenta.id_grupo_cuenta}.{$cuenta.id_cuenta_mayor}.{$cuenta.id_cuenta} {$cuenta.nombre_cuenta} {$cuenta.abreviatura_clase_cuenta}</option>
                                {/foreach}
                                </select>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2"><center id="nombre_cuenta_izquierda">Nombre cuenta (A)</center></th>
                                            </tr>
                                            <tr>
                                                <th><center>Debe</center></th>
                                                <th><center>Haber</center></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <th><center><b id="izquierda_debe">999.99</b></center></th>
                                                <th><center><b id="izquierda_haber">999.99</b></center></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-4">
                                <br />
                                <br />
                                <center>
                                    <div class="radio">
                                        <label><input type="radio" name="opcion_lado" id="opcion_lado" value="debe">Esta transaccion empieza en el debe</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="opcion_lado" id="opcion_lado" value="haber">Esta transaccion empieza en el haber</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Monto:</label>
                                        <input type="text" class="form-control" id="txt_monto" name="txt_monto" value="{$salario_real_mensual}">
                                    </div>
                                </center>
                            </div>
                            
                            
                            <div class="col-sm-4">
                                <label for="usr">Cuenta final:</label>
                                <select class="form-control" id="cuenta_derecha" name="cuenta_derecha">
                                {foreach item=cuenta from=$cuentas}
                                    <option value="{$cuenta.id_cuenta_interno},{$cuenta.id_clase_cuenta},{$cuenta.id_grupo_cuenta},{$cuenta.id_cuenta_mayor},{$cuenta.id_cuenta}">{$cuenta.id_clase_cuenta}.{$cuenta.id_grupo_cuenta}.{$cuenta.id_cuenta_mayor}.{$cuenta.id_cuenta} {$cuenta.nombre_cuenta} {$cuenta.abreviatura_clase_cuenta}</option>
                                {/foreach}
                                </select>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2"><center id="nombre_cuenta_derecha">Nombre cuenta (A)</center></th>
                                            </tr>
                                            <tr>
                                                <th><center>Debe</center></th>
                                                <th><center>Haber</center></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <th><center><b id="derecha_debe">999.99</b></center></th>
                                                <th><center><b id="derecha_haber">999.99</b></center></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
						
						<div class="row">
							<div class="col-xs-12">
								<button type="submit" class="btn btn-success">Crear transaccion</button>
							</div>
						</div>
                    </div>
				</div>
			</div>
			</form>
			
			<div class="panel panel-primary">
                <div class="panel-heading">Costos registrados</div>
                <div class="panel-body">
					<div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>Fecha realizacion</center></th>
                                    <th><center>Monto costo</center></th>
                                </tr>
                            </thead>
                            <tbody>
								{foreach item=$pago from=$pagos}
								<tr>
									<th><center>{$pago.fecha_pago}</center></th>
									<th><center>{$pago.monto_pago}</center></th>
								</tr>
								{/foreach}
							</tbody>
                        </table>
                    </div>
				</div>
			</div>
			
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="{$base_url}js/bootstrap.min.js"></script>
		<script src="{$base_url}js/crear_transaccion.js"></script>
    </body>
</html>
