<?php
/* Smarty version 3.1.30, created on 2017-12-01 02:06:06
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\ver_transacciones_cuenta.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a20b90e983b49_65213387',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6994a263c56dfc8ecbeca0b42f45c865b9e9832b' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\ver_transacciones_cuenta.php',
      1 => 1512093938,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a20b90e983b49_65213387 (Smarty_Internal_Template $_smarty_tpl) {
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
            
			<form action="/sic115/index.php/vertransaccionescuenta/procesarconsulta" method="POST">
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
                <div class="panel-heading">Estado de cuenta <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['nombre_cuenta'];?>
</div>
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
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['transacciones_desplegar']->value, 'transaccion');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['transaccion']->value) {
?>
                                <?php if ($_smarty_tpl->tpl_vars['transaccion']->value['esta_en_debe'] == 'V') {?>
                                <tr>
                                    <th><center>-</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['transaccion']->value['monto'];?>
</center></th>
                                    <th><center>-</center></th>
                                </tr>
                                <?php } else { ?>
                                <tr>
                                    <th><center>-</center></th>
                                    <th><center>-</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['transaccion']->value['monto'];?>
</center></th>
                                </tr>
                                <?php }?>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total</center></th>
                                    <?php if ($_smarty_tpl->tpl_vars['saldo_debe']->value > -1) {?>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_debe']->value;?>
</center></th>
                                    <th><center>-</center></th>
                                    <?php } else { ?>
                                    <th><center>-</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_haber']->value;?>
</center></th>
                                    <?php }?>
                                </tr>
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
</html><?php }
}
