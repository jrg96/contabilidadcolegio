<?php
/* Smarty version 3.1.30, created on 2017-11-25 20:42:56
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\modificar_criterio_reparto_primario.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a19d5d01bff65_49738963',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ec39dcc3a96caa7779f7f57a19b21a68bcd84215' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\modificar_criterio_reparto_primario.php',
      1 => 1511642570,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a19d5d01bff65_49738963 (Smarty_Internal_Template $_smarty_tpl) {
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
            
            <form action="/sic115/index.php/modificarcriteriorepartoprimario/procesar" method="POST">
				<input type="hidden" name="id_criterio_reparto_primario" id="id_criterio_reparto_primario" value="<?php echo $_smarty_tpl->tpl_vars['criterio_reparto_primario']->value['id_criterio_reparto_primario'];?>
" />
                <div class="panel panel-primary">
                    <div class="panel-heading">Modificar criterio de reparto primario</div>
                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label for="id_cuenta">La cuenta a repartir es:</label>
                            <select class="form-control" id="cuenta_a_repartir" name="cuenta_a_repartir">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cuentas']->value, 'cuenta');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cuenta']->value) {
?>
								<?php if ($_smarty_tpl->tpl_vars['criterio_reparto_primario']->value['id_cuenta_interno'] == $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_interno']) {?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_interno'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['nombre_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['abreviatura_clase_cuenta'];?>
</option>
								<?php } else { ?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_interno'];?>
"><?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['nombre_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['abreviatura_clase_cuenta'];?>
</option>
								<?php }?>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="usr">Nombre de criterio de reparto primario:</label>
                            <input type="text" class="form-control" id="nombre_criterio_reparto_primario" name="nombre_criterio_reparto_primario" value="<?php echo $_smarty_tpl->tpl_vars['criterio_reparto_primario']->value['nombre_criterio_reparto_primario'];?>
">
                        </div>
						
						<div class="form-group">
                            <label for="usr">Descripcion de criterio de reparto primario:</label>
                            <input type="text" class="form-control" id="desc_criterio_reparto_primario" name="desc_criterio_reparto_primario" value="<?php echo $_smarty_tpl->tpl_vars['criterio_reparto_primario']->value['desc_criterio_reparto_primario'];?>
">
                        </div>
						
						<div class="form-group">
                            <label for="usr">Unidad en la que estarán expresados los valores:</label>
                            <input type="text" class="form-control" id="unidad_reparto" name="unidad_reparto" value="<?php echo $_smarty_tpl->tpl_vars['criterio_reparto_primario']->value['unidad_reparto'];?>
">
                        </div>
                    </div>
                </div>
				
				<div class="panel panel-primary">
					<div class="panel-heading">Valores para los centros de costo</div>
					<div class="panel-body">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['centros_costo']->value, 'centro');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['centro']->value) {
?>
						<div class="form-group">
                            <label for="usr">Valor para <?php echo $_smarty_tpl->tpl_vars['centro']->value['nombre_centro_costo'];?>
:</label>
                            <input type="text" class="form-control" id="unidad_reparto_<?php echo $_smarty_tpl->tpl_vars['centro']->value['id_unidad_reparto_primario'];?>
" name="unidad_reparto_<?php echo $_smarty_tpl->tpl_vars['centro']->value['id_unidad_reparto_primario'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['centro']->value['valor_unidad'];?>
">
                        </div>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

						<button type="submit" class="btn btn-success">Editar criterio de reparto primario</input>
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
