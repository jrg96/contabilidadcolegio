<?php
/* Smarty version 3.1.30, created on 2017-11-26 16:35:08
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\modificar_actividad.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a1aed3c03c0e8_60639685',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '55d785dce17d9655ce884ea2d647471fb1d5a40b' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\modificar_actividad.php',
      1 => 1511713622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a1aed3c03c0e8_60639685 (Smarty_Internal_Template $_smarty_tpl) {
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
            
            <form action="/sic115/index.php/modificaractividad/procesar" method="POST">
				<input type="hidden" name="id_actividad" id="id_actividad" value="<?php echo $_smarty_tpl->tpl_vars['actividad']->value['id_actividad'];?>
"/>
                <div class="panel panel-primary">
                    <div class="panel-heading">Modificar actividad</div>
                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label for="id_cuenta">La actividad pertenece al centro de costo:</label>
                            <select class="form-control" id="id_centro_costo" name="id_centro_costo">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['centros_costo']->value, 'centro');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['centro']->value) {
?>
								<?php if ($_smarty_tpl->tpl_vars['actividad']->value['id_centro_costo'] == $_smarty_tpl->tpl_vars['centro']->value['id_centro_costo']) {?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['centro']->value['id_centro_costo'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['centro']->value['nombre_centro_costo'];?>
</option>
								<?php } else { ?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['centro']->value['id_centro_costo'];?>
"><?php echo $_smarty_tpl->tpl_vars['centro']->value['nombre_centro_costo'];?>
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
                            <label for="usr">Nombre de la actividad:</label>
                            <input type="text" class="form-control" id="nombre_actividad" name="nombre_actividad" value="<?php echo $_smarty_tpl->tpl_vars['actividad']->value['nombre_actividad'];?>
">
                        </div>
						
						<div class="form-group">
                            <label for="usr">Descripcion de la actividad:</label>
                            <input type="text" class="form-control" id="descripcion_actividad" name="descripcion_actividad" value="<?php echo $_smarty_tpl->tpl_vars['actividad']->value['descripcion_actividad'];?>
">
                        </div>
						
						<div class="form-group">
                            <label for="id_cuenta">Tipo de actividad:</label>
                            <select class="form-control" id="tipo_actividad" name="tipo_actividad">
								<?php if ($_smarty_tpl->tpl_vars['actividad']->value['tipo_actividad'] == 'Primaria') {?>
                                <option value="Primaria" selected>Primaria</option>
								<option value="Auxiliar">Auxiliar</option>
								<?php } else { ?>
								<option value="Primaria">Primaria</option>
								<option value="Auxiliar" selected>Auxiliar</option>
								<?php }?>
                            </select>
                        </div>
						
						<button type="submit" class="btn btn-success">Modificar Actividad</input>
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
