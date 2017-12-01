<?php
/* Smarty version 3.1.30, created on 2017-12-01 02:07:10
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\lista_actividad.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a20b94e9e2b12_31671082',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f1c3de587d1d5be89c681455c1a1d2508504cd50' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\lista_actividad.php',
      1 => 1512093708,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a20b94e9e2b12_31671082 (Smarty_Internal_Template $_smarty_tpl) {
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
									<th><center>Pertenece a</center></th>
                                    <th><center>Actualizar</center></th>
                                    <th><center>Eliminar</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['actividades']->value, 'actividad');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['actividad']->value) {
?>
                                <tr>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['actividad']->value['nombre_actividad'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['actividad']->value['descripcion_actividad'];?>
</center></th>
									<th><center><?php echo $_smarty_tpl->tpl_vars['actividad']->value['nombre_centro_costo'];?>
</center></th>
                                    <th><center><a href="/sic115/index.php/modificaractividad/index/<?php echo $_smarty_tpl->tpl_vars['actividad']->value['id_actividad'];?>
">Actualizar</a></center></th>
                                    <th><center><a href="/sic115/index.php/eliminaractividad/index/<?php echo $_smarty_tpl->tpl_vars['actividad']->value['id_actividad'];?>
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
