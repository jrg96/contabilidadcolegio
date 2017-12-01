<?php
/* Smarty version 3.1.30, created on 2017-11-05 17:40:36
  from "C:\Program Files\EasyPHP-Devserver-17\eds-www\sic115\application\views\templates\crear_transaccion.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59ff3f046c6c14_76120319',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8037fbbc2dc4e806dc7fe5631b88a6e45827f33f' => 
    array (
      0 => 'C:\\Program Files\\EasyPHP-Devserver-17\\eds-www\\sic115\\application\\views\\templates\\crear_transaccion.php',
      1 => 1509900026,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59ff3f046c6c14_76120319 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crear transaccion</title>
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
            <form action="/sic115/index.php/creartransaccion/procesar" method="POST">
            <input type='hidden' value='off' name='es_transaccion_ajuste'>
            <div class="panel panel-primary">
                <div class="panel-heading">Crear transaccion</div>
                <div class="panel-body">
                    <div class="form-group">
                        
                        
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="usr">Cuenta inicial:</label>
                                <select class="form-control" id="cuenta_izquierda" name="cuenta_izquierda">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cuentas']->value, 'cuenta');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cuenta']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_interno'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
"><?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['nombre_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['abreviatura_clase_cuenta'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                </select>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2"><center id="nombre_cuenta_izquierda">Nombre cuenta (A)</center></th>
                                            </tr>
                                            <tr>
                                                <th><center>Debe</center></th>
                                                <th><center>Haber</center></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <th><center><b id="izquierda_debe">999.99</b></center></th>
                                                <th><center><b id="izquierda_haber">999.99</b></center></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-4">
                                <br />
                                <br />
                                <center>
                                    <div class="radio">
                                        <label><input type="radio" name="opcion_lado" id="opcion_lado" value="debe">Esta transaccion empieza en el debe</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="opcion_lado" id="opcion_lado" value="haber">Esta transaccion empieza en el haber</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="usr">Monto:</label>
                                        <input type="text" class="form-control" id="txt_monto" name="txt_monto">
                                    </div>
                                </center>
                            </div>
                            
                            
                            <div class="col-sm-4">
                                <label for="usr">Cuenta final:</label>
                                <select class="form-control" id="cuenta_derecha" name="cuenta_derecha">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cuentas']->value, 'cuenta');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cuenta']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_interno'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
"><?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['nombre_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['abreviatura_clase_cuenta'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                </select>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2"><center id="nombre_cuenta_derecha">Nombre cuenta (A)</center></th>
                                            </tr>
                                            <tr>
                                                <th><center>Debe</center></th>
                                                <th><center>Haber</center></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <th><center><b id="derecha_debe">999.99</b></center></th>
                                                <th><center><b id="derecha_haber">999.99</b></center></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <h4>Atributos especiales</h4>
                            <div class="checkbox">
                                <label><input type="checkbox" name="es_transaccion_ajuste">Esta transaccion es de ajuste</label>
                            </div>
                            <br />
                            <button type="submit" class="btn btn-success">Crear transaccion</button>
                        </div>
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
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
js/crear_transaccion.js"><?php echo '</script'; ?>
>
    </body>
</html>
<?php }
}
