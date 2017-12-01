<?php
/* Smarty version 3.1.30, created on 2017-12-01 02:06:41
  from "H:\tpi\USBWebserver v8.6\root\sic115\application\views\templates\contabilidad_costos.php" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a20b9315ea710_52165858',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a019075c3ac0b85281fb76fea4d34349bd9b1c9' => 
    array (
      0 => 'H:\\tpi\\USBWebserver v8.6\\root\\sic115\\application\\views\\templates\\contabilidad_costos.php',
      1 => 1512093526,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a20b9315ea710_52165858 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contabilidad de Costos</title>
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
            <div class="starter-template">
                <h1>Acciones a realizar contabilidad de costos</h1>
                
                <div class="panel panel-primary">
                    <div class="panel-heading">Centros de costo</div>
                    <div class="panel-body">
                        <a href="/sic115/index.php/crearcentrocosto/index" class="btn btn-info" role="button">Crear centro de costo</a>
						<a href="/sic115/index.php/listacentroscosto/index" class="btn btn-info" role="button">Ver centros de costo</a>
                    </div>
                </div>
				
				<div class="panel panel-primary">
                    <div class="panel-heading">Criterios de reparto primario</div>
                    <div class="panel-body">
                        <a href="/sic115/index.php/crearcriteriorepartoprimario/index" class="btn btn-info" role="button">Crear criterio reparto primario</a>
						<a href="/sic115/index.php/listacriteriorepartoprimario/index" class="btn btn-info" role="button">Lista criterio reparto primario</a>
						<a href="/sic115/index.php/verrepartoprimario/index" class="btn btn-info" role="button">Ver reparticion criterio reparto primario</a>
                    </div>
                </div>
				
				<div class="panel panel-primary">
                    <div class="panel-heading">Actividades</div>
                    <div class="panel-body">
                        <a href="/sic115/index.php/crearactividad/index" class="btn btn-info" role="button">Crear actividad</a>
						<a href="/sic115/index.php/listaactividades/index" class="btn btn-info" role="button">Ver actividades</a>
                    </div>
                </div>
				
				<div class="panel panel-primary">
                    <div class="panel-heading">Criterios de reparto secundario</div>
                    <div class="panel-body">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['centros_costo']->value, 'centro');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['centro']->value) {
?>
                        <a href="/sic115/index.php/crearcriteriorepartosecundario/index/<?php echo $_smarty_tpl->tpl_vars['centro']->value['id_centro_costo'];?>
" class="btn btn-info" role="button">Modificar criterio de reparto para <?php echo $_smarty_tpl->tpl_vars['centro']->value['nombre_centro_costo'];?>
</a>
						<br />
						<br />
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

						<br />
						<br />
						<br />
						<a href="/sic115/index.php/listacriteriorepartosecundario/index" class="btn btn-info" role="button">Ver Lista de criterios de reparto secundarios</a>
						<a href="/sic115/index.php/verrepartosecundario/index" class="btn btn-info" role="button">Ver reparto secundario</a>
                    </div>
                </div>
                
				<div class="panel panel-primary">
                    <div class="panel-heading">Criterios de reparto terciarios (Actividades auxiliares)</div>
                    <div class="panel-body">
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['actividades_auxiliares']->value, 'actividad');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['actividad']->value) {
?>
                        <a href="/sic115/index.php/crearcriteriorepartoterciario/index/<?php echo $_smarty_tpl->tpl_vars['actividad']->value['id_actividad'];?>
" class="btn btn-info" role="button">Modificar criterio de reparto para <?php echo $_smarty_tpl->tpl_vars['actividad']->value['nombre_actividad'];?>
</a>
						<br />
						<br />
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

						<br />
						<br />
						<br />
						<a href="/sic115/index.php/listacriteriorepartoterciario/index" class="btn btn-info" role="button">Ver Lista de criterios de reparto terciarios</a>
						<a href="/sic115/index.php/verrepartoterciario/index" class="btn btn-info" role="button">Ver reparto terciario</a>
                    </div>
                </div>
				
				<!--
				<div class="panel panel-primary">
                    <div class="panel-heading">Inductores de costo</div>
                    <div class="panel-body">
                        <a href="/sic115/index.php/crearinductorcosto/index" class="btn btn-info" role="button">Asignar nombres a los inductores de costo</a>
						<a href="/sic115/index.php/crearconsumidorcosto/index" class="btn btn-info" role="button">Crear consumidor costo</a>
						<a href="/sic115/index.php/listaconsumidorescosto/index" class="btn btn-info" role="button">Ver consumidores de costo</a>
						<a href="/sic115/index.php/vercostounitarioactividad/index" class="btn btn-info" role="button">Ver costos unitarios inductores de costos</a>
                    </div>
                </div>
				-->
				
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
