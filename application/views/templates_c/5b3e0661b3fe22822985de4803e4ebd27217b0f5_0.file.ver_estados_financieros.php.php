<?php
/* Smarty version 3.1.30, created on 2017-11-30 20:06:24
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\ver_estados_financieros.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a20b920a48631_29825813',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5b3e0661b3fe22822985de4803e4ebd27217b0f5' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\ver_estados_financieros.php',
      1 => 1512093884,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a20b920a48631_29825813 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Starter Template for Bootstrap</title>
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
			<input type="hidden" name="id_cuenta" id="id_cuenta" value="<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_interno'];?>
">
			<div class="panel panel-primary">
                <div class="panel-heading">Periodo contable a consultar</div>
                <div class="panel-body">
					<label for="usr">Periodo contable:</label>
					<select class="form-control" id="id_periodo_contable" name="id_periodo_contable">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['periodos']->value, 'periodo');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['periodo']->value) {
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['periodo']->value['id_periodo_contable'];?>
">desde: <?php echo $_smarty_tpl->tpl_vars['periodo']->value['fecha_inicio'];?>
 - hasta: <?php echo $_smarty_tpl->tpl_vars['periodo']->value['fecha_final'];?>
</option>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['datos_a_desplegar']->value, 'fila');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fila']->value) {
?>
                                <tr>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['nombre'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['debe_no_ajuste'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['haber_no_ajuste'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['debe_ajuste'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['haber_ajuste'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['debe_todo'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['haber_todo'];?>
</center></th>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_debe_no_ajuste']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_haber_no_ajuste']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_debe_ajuste']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_haber_ajuste']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_debe_todo']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_haber_todo']->value;?>
</center></th>
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
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['datos_resultado_a_desplegar']->value, 'fila');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fila']->value) {
?>
                                <tr>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['nombre'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['debe'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['haber'];?>
</center></th>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_debe_resultado']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_haber_resultado']->value;?>
</center></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <h4>Estado: <?php echo $_smarty_tpl->tpl_vars['mensaje_estado_empresa']->value;?>
</h4>
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
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['datos_capital_a_desplegar']->value, 'fila');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fila']->value) {
?>
                                <tr>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['nombre'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['debe'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['haber'];?>
</center></th>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total (Capital contable)</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_debe_capital']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_haber_capital']->value;?>
</center></th>
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
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['datos_balancegeneral_a_desplegar']->value, 'fila');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fila']->value) {
?>
                                <tr>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['nombre'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['debe'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['haber'];?>
</center></th>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_debe_balance_general']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_haber_balance_general']->value;?>
</center></th>
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
					<p><b>Inicio del siguient periodo contable: <?php echo $_smarty_tpl->tpl_vars['fecha_nuevo_periodo']->value;?>
</b></p>
					<br />
					<button type="submit" class="btn btn-success">Cerrar periodo contable</input>
                </div>
            </div>
			</form>
			
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
    </body>
</html><?php }
}
