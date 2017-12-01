<?php
/* Smarty version 3.1.30, created on 2017-11-27 00:42:10
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\crear_inductor_costo.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a1b5f6281fe00_17523047',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '562a3928ff85fc18bfa201ce405408b299e67d21' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\crear_inductor_costo.php',
      1 => 1511743200,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a1b5f6281fe00_17523047 (Smarty_Internal_Template $_smarty_tpl) {
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
            
			<?php if ($_smarty_tpl->tpl_vars['es_nuevo_registro']->value == 'si') {?>
            <form action="/sic115/index.php/crearinductorcosto/procesarinsertar" method="POST">
			<?php } else { ?>
			<form action="/sic115/index.php/crearinductorcosto/procesarmodificar" method="POST">
			<?php }?>
				<input type="hidden" name="es_nuevo_registro" id="es_nuevo_registro" value="<?php echo $_smarty_tpl->tpl_vars['es_nuevo_registro']->value;?>
" />
				
				<div class="panel panel-primary">
					<div class="panel-heading">Inductores para las actividades</div>
					<div class="panel-body">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['actividades']->value, 'actividad');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['actividad']->value) {
?>
						<div class="form-group">
                            <label for="usr">Valor para <?php echo $_smarty_tpl->tpl_vars['actividad']->value['nombre_actividad'];?>
:</label>
							<?php if ($_smarty_tpl->tpl_vars['es_nuevo_registro']->value == 'si') {?>
                            <input type="text" class="form-control" id="actividad_<?php echo $_smarty_tpl->tpl_vars['actividad']->value['id_actividad'];?>
" name="actividad_<?php echo $_smarty_tpl->tpl_vars['actividad']->value['id_actividad'];?>
">
							<?php } else { ?>
							<input type="text" class="form-control" id="inductor_<?php echo $_smarty_tpl->tpl_vars['actividad']->value['id_inductor_costo'];?>
" name="inductor_<?php echo $_smarty_tpl->tpl_vars['actividad']->value['id_inductor_costo'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['actividad']->value['nombre_inductor_costo'];?>
">
							<?php }?>
                        </div>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

						<button type="submit" class="btn btn-success">Crear inductores de costo</input>
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
