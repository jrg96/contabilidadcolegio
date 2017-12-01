<?php
/* Smarty version 3.1.30, created on 2017-12-01 02:07:31
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\ver_reparto_terciario.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a20b9635be855_59310507',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b11102cd6afd4404dbfd716e580460787ef78062' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\ver_reparto_terciario.php',
      1 => 1512093926,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a20b9635be855_59310507 (Smarty_Internal_Template $_smarty_tpl) {
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
            
            <div class="panel panel-primary">
                <div class="panel-heading">Distribucion terciaria de los costos</div>
                <div class="panel-body">
            
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th rowspan="4"><center>Nombre centro de costo</center></th>
									<th rowspan="4"><center>Saldo inicial</center></th>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['criterios_aplicados']->value, 'criterio');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['criterio']->value) {
?>
									<th colspan="3"><center>Criterio: <?php echo $_smarty_tpl->tpl_vars['criterio']->value['nombre_criterio'];?>
</center></th>
									<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

									<th rowspan="4"><center>Total aportado</center></th>
									<th rowspan="4"><center>Total actividad</center></th>
                                </tr>
								<tr>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['criterios_aplicados']->value, 'criterio');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['criterio']->value) {
?>
									<th colspan="3"><center>Total unidades <?php echo $_smarty_tpl->tpl_vars['criterio']->value['total_unidades'];?>
</center></th>
									<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

								</tr>
								<tr>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['criterios_aplicados']->value, 'criterio');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['criterio']->value) {
?>
									<th colspan="3"><center>Actividad repartida: <?php echo $_smarty_tpl->tpl_vars['criterio']->value['actividad_repartida'];?>
</center></th>
									<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

								</tr>
								<tr>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['criterios_aplicados']->value, 'criterio');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['criterio']->value) {
?>
									<th><center>Valor unidad</center></th>
									<th><center>Factor</center></th>
									<th><center>$ correspondiente</center></th>
									<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

								</tr>
                            </thead>
                            <tbody>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['info_a_desplegar']->value, 'fila');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fila']->value) {
?>
								<tr>
									<th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['nombre_actividad'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['saldo_inicial'];?>
</center></th>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['fila']->value['criterios_aplicados'], 'criterio');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['criterio']->value) {
?>
									<th><center><?php echo $_smarty_tpl->tpl_vars['criterio']->value['valor_unidad'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['criterio']->value['factor'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['criterio']->value['dinero_correspondiente'];?>
</center></th>
									<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

									<th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['saldo_agregado'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['saldo_total'];?>
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
									<th><center>Total: </center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['totales_finales']->value['total_saldo_base'];?>
</center></th>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['totales_finales']->value['totales_criterios'], 'criterio');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['criterio']->value) {
?>
									<th><center><?php echo $_smarty_tpl->tpl_vars['criterio']->value['valor_unidad'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['criterio']->value['factor'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['criterio']->value['total_correspondiente'];?>
</center></th>
									<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

									<th><center><?php echo $_smarty_tpl->tpl_vars['totales_finales']->value['total_saldo_aplicado'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['totales_finales']->value['total_saldo_final'];?>
</center></th>
								</tr>
							</tfoot>
                        </table>
                    </div>
                </div>
            </div>
			
			<div class="panel panel-primary">
                <div class="panel-heading">En resumen se tiene</div>
                <div class="panel-body">
					<div class="table-responsive">
                        <table class="table">
							<thead>
								<tr>
									<th><center>Nombre actividad</center></th>
									<th><center>Costo base</center></th>
									<th><center>Costo agregado</center></th>
									<th><center>Costo total</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['info_a_desplegar']->value, 'fila');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fila']->value) {
?>
								<tr>
									<th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['nombre_actividad'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['saldo_inicial'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['saldo_agregado'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['saldo_total'];?>
</center></th>
								</tr>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

							</tbody>
							<tfoot>
								<th><center>Total:</center></th>
								<th><center><?php echo $_smarty_tpl->tpl_vars['totales_finales']->value['total_saldo_base'];?>
</center></th>
								<th><center><?php echo $_smarty_tpl->tpl_vars['totales_finales']->value['total_saldo_aplicado'];?>
</center></th>
								<th><center><?php echo $_smarty_tpl->tpl_vars['totales_finales']->value['total_saldo_final'];?>
</center></th>
							</tfoot>
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
    </body>
</html>
<?php }
}
