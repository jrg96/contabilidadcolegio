<?php
/* Smarty version 3.1.30, created on 2017-11-30 17:20:07
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\modificar_empleado.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a2092270ce062_43522488',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '315cd6b622b07748f4446d0b2a3fdb760229f83a' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\modificar_empleado.php',
      1 => 1512084002,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a2092270ce062_43522488 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crear cuenta</title>
        <link href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
css/bootstrap.min.css" rel="stylesheet">
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
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">
            <br />
            <br />
            <br />
            
            <?php if ($_smarty_tpl->tpl_vars['resultado_operacion']->value != 'ninguna') {?>
            <div class="alert alert-success">
                <strong><?php echo $_smarty_tpl->tpl_vars['resultado_operacion']->value;?>
</strong> <?php echo $_smarty_tpl->tpl_vars['mensaje_operacion']->value;?>

            </div>
            <?php }?>
            
            <form action="/sic115/index.php/modificarempleado/procesar" method="POST">
				<input type="hidden" name="id_empleado" id="id_empleado" value="<?php echo $_smarty_tpl->tpl_vars['empleado']->value['id_empleado'];?>
" />
                <div class="panel panel-primary">
                    <div class="panel-heading">Modificar empleado</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="usr">Nombre del empleado:</label>
                            <input type="text" class="form-control" id="nombre_empleado" name="nombre_empleado" value="<?php echo $_smarty_tpl->tpl_vars['empleado']->value['nombre_empleado'];?>
">
                        </div>
						
						<div class="form-group">
                            <label for="usr">Fecha de contratacion:</label>
                            <input type="text" class="form-control" id="fecha_contratacion" name="fecha_contratacion" value="<?php echo $_smarty_tpl->tpl_vars['empleado']->value['fecha_contratacion'];?>
">
                        </div>
						
						<div class="form-group">
                            <label for="id_cuenta">Salario nominal diario:</label>
							<input type="text" class="form-control" id="salario_base_diario" name="salario_base_diario" value="<?php echo $_smarty_tpl->tpl_vars['empleado']->value['salario_base_diario'];?>
">
                        </div>
						
						<div class="form-group">
                            <label for="id_cuenta">Tipo empleado:</label>
							<input type="text" class="form-control" id="tipo_empleado" name="tipo_empleado" value="<?php echo $_smarty_tpl->tpl_vars['empleado']->value['tipo_empleado'];?>
">
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
									<th><center><?php echo $_smarty_tpl->tpl_vars['dias_aguinaldo']->value;?>
</center></th>
								</tr>
								<tr>
									<th><center>Aguinaldo semanal: </center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['aguinaldo_semanal']->value;?>
</center></th>
								</tr>
								<tr>
									<th><center>Vacaciones semanal (15 dias + 30% recargo): </center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['vacaciones_semanal']->value;?>
</center></th>
								</tr>
								<tr>
									<th><center>Seguro (6.75%) AFP(7.5%) pagado en vacaciones: </center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['seguro_afp_vacaciones']->value;?>
</center></th>
								</tr>
								<tr>
									<th><center>INSAFORP (1%): </center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['insaforp_semanal']->value;?>
</center></th>
								</tr>
								<tr>
									<th><center>Seguro (6.75%) AFP(7.5%) pagado semanalmente: </center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['seguro_afp_semanal']->value;?>
</center></th>
								</tr>
								<tr>
									<th><center>Costo real semanalmente: </center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['salario_real_semanal']->value;?>
</center></th>
								</tr>
								<tr>
									<th><center>Costo real mensual: </center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['salario_real_mensual']->value;?>
</center></th>
								</tr>
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
			
			<form action="/sic115/index.php/modificarempleado/procesarpago" method="POST">
			<input type="hidden" name="id_empleado" id="id_empleado" value="<?php echo $_smarty_tpl->tpl_vars['empleado']->value['id_empleado'];?>
" />
			<div class="panel panel-primary">
                <div class="panel-heading">Realizar pago</div>
                <div class="panel-body">
				
					<div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="usr">Cuenta inicial:</label>
                                <select class="form-control" id="cuenta_izquierda" name="cuenta_izquierda">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cuentas']->value, 'cuenta');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cuenta']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_interno'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
"><?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['nombre_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['abreviatura_clase_cuenta'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
                                        <input type="text" class="form-control" id="txt_monto" name="txt_monto" value="<?php echo $_smarty_tpl->tpl_vars['salario_real_mensual']->value;?>
">
                                    </div>
                                </center>
                            </div>
                            
                            
                            <div class="col-sm-4">
                                <label for="usr">Cuenta final:</label>
                                <select class="form-control" id="cuenta_derecha" name="cuenta_derecha">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cuentas']->value, 'cuenta');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cuenta']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_interno'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
"><?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['nombre_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['abreviatura_clase_cuenta'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
									<th><center>Eliminar</center></th>
                                </tr>
                            </thead>
                            <tbody>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pagos']->value, 'pago');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pago']->value) {
?>
								<tr>
									<th><center><?php echo $_smarty_tpl->tpl_vars['pago']->value['fecha_pago'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['pago']->value['monto_pago'];?>
</center></th>
									<th><center>Eliminar</center></th>
								</tr>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

							</tbody>
                        </table>
                    </div>
				</div>
			</div>
			
        </div>



        <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
>window.jQuery || document.write('<?php echo '<script'; ?>
 src="../../assets/js/vendor/jquery.min.js"><\/script>')<?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
js/bootstrap.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
js/crear_transaccion.js"><?php echo '</script'; ?>
>
    </body>
</html>
<?php }
}
