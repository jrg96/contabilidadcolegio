<?php
/* Smarty version 3.1.30, created on 2017-11-06 05:40:47
  from "C:\Program Files\EasyPHP-Devserver-17\eds-www\sic115\application\views\templates\ver_estados_financieros.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_59ffe7cfa8f7f3_96787501',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7779c4c532f7d6835cd1a98fcce7efaf7c3387c' => 
    array (
      0 => 'C:\\Program Files\\EasyPHP-Devserver-17\\eds-www\\sic115\\application\\views\\templates\\ver_estados_financieros.php',
      1 => 1509943243,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_59ffe7cfa8f7f3_96787501 (Smarty_Internal_Template $_smarty_tpl) {
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
                <div class="panel-heading">Balance de comprobacion con ajustes</div>
                <div class="panel-body">
                
                
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th rowspan="2"><center>nombre de cuenta</center></th>
                                    <th colspan="2"><center>Valores sin ajuste</center></th>
                                    <th colspan="2"><center>Ajustes</center></th>
                                    <th colspan="2"><center>Valores ajustados</center></th>
                                </tr>
                                <tr>
                                    <th><center>Debe</center></th>
                                    <th><center>Haber</center></th>
                                    <th><center>Debe</center></th>
                                    <th><center>Haber</center></th>
                                    <th><center>Debe</center></th>
                                    <th><center>Haber</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['datos_a_desplegar']->value, 'fila');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fila']->value) {
?>
                                <tr>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['nombre'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['debe_no_ajuste'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['haber_no_ajuste'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['debe_ajuste'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['haber_ajuste'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['debe_todo'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['haber_todo'];?>
</center></th>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_debe_no_ajuste']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_haber_no_ajuste']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_debe_ajuste']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_haber_ajuste']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_debe_todo']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_haber_todo']->value;?>
</center></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Estado de resultado</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>Nombre de cuenta</center></th>
                                    <th><center>Debe</center></th>
                                    <th><center>Haber</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['datos_resultado_a_desplegar']->value, 'fila');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fila']->value) {
?>
                                <tr>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['nombre'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['debe'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['haber'];?>
</center></th>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_debe_resultado']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_haber_resultado']->value;?>
</center></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <h4>Estado: <?php echo $_smarty_tpl->tpl_vars['mensaje_estado_empresa']->value;?>
</h4>
                </div>
            </div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Estado de capital</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>Nombre de la cuenta</center></th>
                                    <th><center>Desinversion</center></th>
                                    <th><center>Inversion</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['datos_capital_a_desplegar']->value, 'fila');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['fila']->value) {
?>
                                <tr>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['nombre'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['debe'];?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['fila']->value['haber'];?>
</center></th>
                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total (Capital contable)</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_debe_capital']->value;?>
</center></th>
                                    <th><center><?php echo $_smarty_tpl->tpl_vars['saldo_haber_capital']->value;?>
</center></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Balance general</div>
                <div class="panel-body">
                    <h4>Ya que se presentaron ganancias, la utilidad retenida es del 40%</h4>
                    <br />
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><center>Nombre de la cuenta</center></th>
                                    <th><center>Debe</center></th>
                                    <th><center>Haber</center></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <th><center>Caja (A)</center></th>
                                    <th><center>128.33</center></th>
                                    <th><center></center></th>
                                </tr>
                                <tr>
                                    <th><center>Capital contable</center></th>
                                    <th><center></center></th>
                                    <th><center>22.22</center></th>
                                </tr>
                                <tr>
                                    <th><center>Utilidad retenida (40%)</center></th>
                                    <th><center>55.23</center></th>
                                    <th><center></center></th>
                                </tr>
                            </tbody>
                            
                            <tfoot>
                                <tr>
                                    <th><center>Total</center></th>
                                    <th><center>123.54</center></th>
                                    <th><center>123.54</center></th>
                                </tr>
                            </tfoot>
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
</html><?php }
}
