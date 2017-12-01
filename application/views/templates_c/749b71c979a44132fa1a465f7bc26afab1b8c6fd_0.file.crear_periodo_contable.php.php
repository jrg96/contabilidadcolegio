<?php
/* Smarty version 3.1.30, created on 2017-10-31 02:22:20
  from "C:\Program Files\EasyPHP-Devserver-17\eds-www\sic115\application\views\templates\crear_periodo_contable.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59f7d04c8e4b93_30869845',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '749b71c979a44132fa1a465f7bc26afab1b8c6fd' => 
    array (
      0 => 'C:\\Program Files\\EasyPHP-Devserver-17\\eds-www\\sic115\\application\\views\\templates\\crear_periodo_contable.php',
      1 => 1509412844,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59f7d04c8e4b93_30869845 (Smarty_Internal_Template $_smarty_tpl) {
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
                        <li><a href="#contact">Contabilidad de costos</a></li>
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
            
            <form action="/sic115/index.php/crearperiodocontable/procesar" method="POST">
            <div class="starter-template">
                <div class="panel panel-primary">
                    <div class="panel-heading">Iniciar periodo contable</div>
                    <div class="panel-body">
                        <label for="usr">Fecha inicio (dia/mes/año):</label>
                        <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio">
                    
                        <br />
                    
                        <label for="usr">Duracion del periodo contable (meses):</label>
                        <input type="text" class="form-control" id="longitud_periodo_contable" name="longitud_periodo_contable" value="<?php echo $_smarty_tpl->tpl_vars['longitud_periodo_contable']->value;?>
"  readonly="readonly">
                        
                        <br />
                        
                        <button type="submit" class="btn btn-success">Crear periodo contable</input>
                    </div>
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
</html<?php }
}
