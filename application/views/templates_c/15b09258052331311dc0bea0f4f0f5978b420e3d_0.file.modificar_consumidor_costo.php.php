<?php
/* Smarty version 3.1.30, created on 2017-11-27 03:00:00
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\modificar_consumidor_costo.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a1b7fb0219d09_40167604',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15b09258052331311dc0bea0f4f0f5978b420e3d' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\modificar_consumidor_costo.php',
      1 => 1511751594,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a1b7fb0219d09_40167604 (Smarty_Internal_Template $_smarty_tpl) {
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
            
            <form action="/sic115/index.php/modificarconsumidorcosto/procesar" method="POST">
				<input type="hidden" name="id_consumidor_costo" id="id_consumidor_costo" value="<?php echo $_smarty_tpl->tpl_vars['consumidor_costo']->value['id_consumidor_costo'];?>
">
                <div class="panel panel-primary">
                    <div class="panel-heading">Modificar consumidor costo</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="usr">Nombre consumidor costo:</label>
                            <input type="text" class="form-control" id="nombre_consumidor_costo" name="nombre_consumidor_costo" value="<?php echo $_smarty_tpl->tpl_vars['consumidor_costo']->value['nombre_consumidor_costo'];?>
">
                        </div>
                    </div>
                </div>
				
				<div class="panel panel-primary">
					<div class="panel-heading">Valores para los inductores de costo</div>
					<div class="panel-body">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['inductores_costo']->value, 'inductor');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['inductor']->value) {
?>
						<div class="form-group">
                            <label for="usr">Valor para <?php echo $_smarty_tpl->tpl_vars['inductor']->value['nombre_inductor_costo'];?>
:</label>
                            <input type="text" class="form-control" id="inductor_<?php echo $_smarty_tpl->tpl_vars['inductor']->value['id_inductor_consumido'];?>
" name="inductor_<?php echo $_smarty_tpl->tpl_vars['inductor']->value['id_inductor_consumido'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['inductor']->value['valor_inductor'];?>
">
                        </div>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

						<button type="submit" class="btn btn-success">Modificar consumidor de costo</input>
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
</html>
<?php }
}
