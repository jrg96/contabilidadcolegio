<?php
/* Smarty version 3.1.30, created on 2017-12-01 02:06:50
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\lista_centro_costo.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a20b93ae94026_71090626',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8bd60c266d8a8d01e27e22c1be8aba41f455551d' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\lista_centro_costo.php',
      1 => 1512093722,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a20b93ae94026_71090626 (Smarty_Internal_Template $_smarty_tpl) {
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
                <div class="panel-heading">Centros de costo</div>
                <div class="panel-body">
            
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>Nombre</center></th>
                                    <th><center>Descripcion</center></th>
                                    <th><center>Actualizar</center></th>
                                    <th><center>Eliminar</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['centros_costo']->value, 'centro');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['centro']->value) {
?>
                                <tr>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['centro']->value['nombre_centro_costo'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['centro']->value['descripcion_centro_costo'];?>
</center></th>
                                    <th><center><a href="/sic115/index.php/modificarcentrocosto/index/<?php echo $_smarty_tpl->tpl_vars['centro']->value['id_centro_costo'];?>
">Actualizar</a></center></th>
                                    <th><center><a href="/sic115/index.php/eliminarcentrocosto/index/<?php echo $_smarty_tpl->tpl_vars['centro']->value['id_centro_costo'];?>
">Eliminar</a></center></th>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </tbody>
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
