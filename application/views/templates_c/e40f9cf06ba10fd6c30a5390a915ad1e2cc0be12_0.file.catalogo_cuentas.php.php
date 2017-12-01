<?php
/* Smarty version 3.1.30, created on 2017-11-05 18:14:22
  from "C:\Program Files\EasyPHP-Devserver-17\eds-www\sic115\application\views\templates\catalogo_cuentas.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59ff46ee59d667_92217535',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e40f9cf06ba10fd6c30a5390a915ad1e2cc0be12' => 
    array (
      0 => 'C:\\Program Files\\EasyPHP-Devserver-17\\eds-www\\sic115\\application\\views\\templates\\catalogo_cuentas.php',
      1 => 1509902057,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59ff46ee59d667_92217535 (Smarty_Internal_Template $_smarty_tpl) {
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
            
            <div class="panel panel-primary">
                <div class="panel-heading">Catalogo de cuentas</div>
                <div class="panel-body">
            
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>Nº Cuenta</center></th>
                                    <th><center>Nombre de cuenta</center></th>
                                    <th><center>Tipo</center></th>
                                    <th><center>Actualizar</center></th>
                                    <th><center>Consultar</center></th>
                                    <th><center>Eliminar</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cuentas']->value, 'cuenta');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cuenta']->value) {
?>
                                <tr>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['cuenta']->value['nombre_cuenta'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['cuenta']->value['clase_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['abreviatura_clase_cuenta'];?>
</center></th>
                                    <th><center><a href="/sic115/index.php/modificarcuenta/index/<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_interno'];?>
">Actualizar</a></center></th>
                                    <th><center><a href="/sic115/index.php/vertransaccionescuenta/index/<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_interno'];?>
">Consultar</a></center></th>
                                    <th><center>link</center></th>
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
