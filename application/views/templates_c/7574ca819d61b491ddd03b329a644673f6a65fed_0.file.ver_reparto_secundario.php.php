<?php
/* Smarty version 3.1.30, created on 2017-12-01 02:07:20
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\ver_reparto_secundario.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a20b958ced2b7_56863641',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7574ca819d61b491ddd03b329a644673f6a65fed' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\ver_reparto_secundario.php',
      1 => 1512093926,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a20b958ced2b7_56863641 (Smarty_Internal_Template $_smarty_tpl) {
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
            
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['info_a_desplegar']->value, 'centro_costo');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['centro_costo']->value) {
?>
			<div class="panel panel-primary">
                <div class="panel-heading">Distribucion secundaria para el centro de costo: <?php echo $_smarty_tpl->tpl_vars['centro_costo']->value['nombre_centro_costo'];?>
</div>
                <div class="panel-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th rowspan="4"><center>Nombre actividad</center></th>
									<th colspan="3"><center><?php echo $_smarty_tpl->tpl_vars['centro_costo']->value['nombre_criterio_reparto'];?>
</center></th>
								</tr>
								<tr>
									<th colspan="3"><center>Dinero disponible: <?php echo $_smarty_tpl->tpl_vars['centro_costo']->value['dinero_disponible'];?>
</center></th>
								</tr>
								<tr>
									<th colspan="3"><center>Total unidades: <?php echo $_smarty_tpl->tpl_vars['centro_costo']->value['total_unidades'];?>
</center></th>
								</tr>
								<tr>
									<th><center>Unidades</center></th>
									<th><center>Factor</center></th>
									<th><center>$ correspondiente</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['centro_costo']->value['actividades'], 'actividad');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['actividad']->value) {
?>
								<tr>
									<th><center><?php echo $_smarty_tpl->tpl_vars['actividad']->value['nombre_actividad'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['actividad']->value['valor_unidad'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['actividad']->value['factor'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['actividad']->value['dinero_correspondiente'];?>
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
									<th><center><?php echo $_smarty_tpl->tpl_vars['centro_costo']->value['unidades_contado'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['centro_costo']->value['factor_contado'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['centro_costo']->value['dinero_contado'];?>
</center></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
