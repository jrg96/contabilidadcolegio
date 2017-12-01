<?php
/* Smarty version 3.1.30, created on 2017-11-06 03:51:39
  from "C:\Program Files\EasyPHP-Devserver-17\eds-www\sic115\application\views\templates\modificar_cuenta.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59ffce3bebbd39_87459705',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '827cdc484bb50dd8c8fdcc24ee2f4c7be9dc93b5' => 
    array (
      0 => 'C:\\Program Files\\EasyPHP-Devserver-17\\eds-www\\sic115\\application\\views\\templates\\modificar_cuenta.php',
      1 => 1509936641,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59ffce3bebbd39_87459705 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Modificar cuenta</title>
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
            
            <form action="/sic115/index.php/modificarcuenta/procesar" method="POST">
                <input type="hidden" name="id_cuenta_interno" id="id_cuenta_interno" value="<?php echo $_smarty_tpl->tpl_vars['cuenta_especifica']->value['id_cuenta_interno'];?>
" />
                <input type="hidden" name="es_desinversion" id="es_desinversion" value="off">
                
                <div class="panel panel-primary">
                    <div class="panel-heading">Modificar cuenta</div>
                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label for="id_cuenta">Id cuenta:</label>
                            <input type="text" class="form-control" id="id_cuenta" name="id_cuenta" value="<?php echo $_smarty_tpl->tpl_vars['cuenta_especifica']->value['id_cuenta'];?>
">
                        </div>
                    
                        <div class="form-group">
                            <label for="usr">Nombre de cuenta:</label>
                            <input type="text" class="form-control" id="nombre_cuenta" name="nombre_cuenta" value="<?php echo $_smarty_tpl->tpl_vars['cuenta_especifica']->value['nombre_cuenta'];?>
">
                        </div>
                        
                        <div class="form-group">
                            <label for="sel1">Clase de cuenta:</label>
                            <select class="form-control" id="clase_cuenta" name="clase_cuenta">
                                <option value="1" <?php if ($_smarty_tpl->tpl_vars['cuenta_especifica']->value['id_clase_cuenta'] == 1) {?> selected <?php }?>>Activo  (A)</option>
                                <option value="2" <?php if ($_smarty_tpl->tpl_vars['cuenta_especifica']->value['id_clase_cuenta'] == 2) {?> selected <?php }?>>Pasivo  (P)</option>
                                <option value="3" <?php if ($_smarty_tpl->tpl_vars['cuenta_especifica']->value['id_clase_cuenta'] == 3) {?> selected <?php }?>>Capital (K)</option>
                                <option value="4" <?php if ($_smarty_tpl->tpl_vars['cuenta_especifica']->value['id_clase_cuenta'] == 4) {?> selected <?php }?>>Ingreso (R)</option>
                                <option value="5" <?php if ($_smarty_tpl->tpl_vars['cuenta_especifica']->value['id_clase_cuenta'] == 5) {?> selected <?php }?>>Egreso  (R)</option>
                            </select>
                        </div> 
                        
                        <div class="form-group">
                            <label for="sel1">Grupo de cuenta:</label>
                            <select class="form-control" id="grupo_cuenta" name="grupo_cuenta">
                                <option value="1" <?php if ($_smarty_tpl->tpl_vars['cuenta_especifica']->value['id_grupo_cuenta'] == 1) {?> selected <?php }?>>Circulante  (C)</option>
                                <option value="2" <?php if ($_smarty_tpl->tpl_vars['cuenta_especifica']->value['id_grupo_cuenta'] == 2) {?> selected <?php }?>>No Circulante (NC)</option>
                            </select>
                        </div> 
                        
                        <div class="form-group">
                            <label for="sel1">Es una cuenta detalle de:</label>
                            <select class="form-control" id="detalle_de" name="detalle_de">
                                <?php if ($_smarty_tpl->tpl_vars['cuenta_especifica']->value['id_cuenta_mayor'] == -1) {?>
                                    <option value="-1" selected>Ninguna</option>
                                <?php } else { ?>
                                    <option value="-1">Ninguna</option>
                                <?php }?>
                                
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cuentas']->value, 'cuenta');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cuenta']->value) {
?>
                                    <?php if (($_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'] == $_smarty_tpl->tpl_vars['cuenta_especifica']->value['id_cuenta_mayor']) && ($_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'] == NULL)) {?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['nombre_cuenta'];?>
</option>
                                    <?php } else { ?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
,<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
"><?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_clase_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_grupo_cuenta'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta_mayor'];?>
.<?php echo $_smarty_tpl->tpl_vars['cuenta']->value['id_cuenta'];?>
 <?php echo $_smarty_tpl->tpl_vars['cuenta']->value['nombre_cuenta'];?>
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
                            <label for="sel1">Atributo especial:</label>
                            <div class="checkbox">
                                <label><input type="checkbox" name="es_desinversion">Cuenta desinversion</label>
                            </div>
                        </div> 
                        
                        <button type="submit" class="btn btn-success">Crear cuenta</input>
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
