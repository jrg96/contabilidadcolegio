<?php
/* Smarty version 3.1.30, created on 2017-11-25 18:12:44
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\modificar_centro_costo.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a19b29cc5ee56_79794943',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f75cc755d5f56b32d09a124d4cf300a3b15b4f9f' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\modificar_centro_costo.php',
      1 => 1511633044,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a19b29cc5ee56_79794943 (Smarty_Internal_Template $_smarty_tpl) {
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
            
            <form action="/sic115/index.php/modificarcentrocosto/procesar" method="POST">
				<input type="hidden" name="id_centro_costo" id="id_centro_costo" value="<?php echo $_smarty_tpl->tpl_vars['centro_costo']->value['id_centro_costo'];?>
" />
                <div class="panel panel-primary">
                    <div class="panel-heading">Modificar centro de costo</div>
                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label for="id_cuenta">Nombre del centro de costo:</label>
                            <input type="text" class="form-control" id="nombre_centro_costo" name="nombre_centro_costo" value="<?php echo $_smarty_tpl->tpl_vars['centro_costo']->value['nombre_centro_costo'];?>
">
                        </div>
                    
                        <div class="form-group">
                            <label for="usr">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion_centro_costo" name="descripcion_centro_costo" value="<?php echo $_smarty_tpl->tpl_vars['centro_costo']->value['descripcion_centro_costo'];?>
">
                        </div>
                        
                        <button type="submit" class="btn btn-success">Modificar centro costo</input>
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
