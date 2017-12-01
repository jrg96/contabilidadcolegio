<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Modificar cuenta</title>
        <link href="{$base_url}css/bootstrap.min.css" rel="stylesheet">
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
            
            {if $resultado_operacion neq 'ninguna'}
            <div class="alert alert-success">
                <strong>{$resultado_operacion}</strong> {$mensaje_operacion}
            </div>
            {/if}
            
            <form action="/sic115/index.php/modificarcuenta/procesar" method="POST">
                <input type="hidden" name="id_cuenta_interno" id="id_cuenta_interno" value="{$cuenta_especifica.id_cuenta_interno}" />
                <input type="hidden" name="es_desinversion" id="es_desinversion" value="off">
				<input type="hidden" name="es_capitalemp" id="es_capitalemp" value="off">
				<input type="hidden" name="es_utilidadret" id="es_utilidadret" value="off">
                
                <div class="panel panel-primary">
                    <div class="panel-heading">Modificar cuenta</div>
                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label for="id_cuenta">Id cuenta:</label>
                            <input type="text" class="form-control" id="id_cuenta" name="id_cuenta" value="{$cuenta_especifica.id_cuenta}">
                        </div>
                    
                        <div class="form-group">
                            <label for="usr">Nombre de cuenta:</label>
                            <input type="text" class="form-control" id="nombre_cuenta" name="nombre_cuenta" value="{$cuenta_especifica.nombre_cuenta}">
                        </div>
                        
                        <div class="form-group">
                            <label for="sel1">Clase de cuenta:</label>
                            <select class="form-control" id="clase_cuenta" name="clase_cuenta">
                                <option value="1" {if $cuenta_especifica.id_clase_cuenta eq 1} selected {/if}>Activo  (A)</option>
                                <option value="2" {if $cuenta_especifica.id_clase_cuenta eq 2} selected {/if}>Pasivo  (P)</option>
                                <option value="3" {if $cuenta_especifica.id_clase_cuenta eq 3} selected {/if}>Capital (K)</option>
                                <option value="4" {if $cuenta_especifica.id_clase_cuenta eq 4} selected {/if}>Ingreso (R)</option>
                                <option value="5" {if $cuenta_especifica.id_clase_cuenta eq 5} selected {/if}>Egreso  (R)</option>
                            </select>
                        </div> 
                        
                        <div class="form-group">
                            <label for="sel1">Grupo de cuenta:</label>
                            <select class="form-control" id="grupo_cuenta" name="grupo_cuenta">
                                <option value="1" {if $cuenta_especifica.id_grupo_cuenta eq 1} selected {/if}>Circulante  (C)</option>
                                <option value="2" {if $cuenta_especifica.id_grupo_cuenta eq 2} selected {/if}>No Circulante (NC)</option>
                            </select>
                        </div> 
                        
                        <div class="form-group">
                            <label for="sel1">Es una cuenta detalle de:</label>
                            <select class="form-control" id="detalle_de" name="detalle_de">
                                {if $cuenta_especifica.id_cuenta_mayor eq -1}
                                    <option value="-1" selected>Ninguna</option>
                                {else}
                                    <option value="-1">Ninguna</option>
                                {/if}
                                
                                {foreach item=cuenta from=$cuentas}
                                    {if ($cuenta.id_cuenta_mayor == $cuenta_especifica.id_cuenta_mayor) && ($cuenta.id_cuenta == NULL)}
                                        <option value="{$cuenta.id_clase_cuenta},{$cuenta.id_grupo_cuenta},{$cuenta.id_cuenta_mayor},{$cuenta.id_cuenta}" selected>{$cuenta.id_clase_cuenta}.{$cuenta.id_grupo_cuenta}.{$cuenta.id_cuenta_mayor}.{$cuenta.id_cuenta} {$cuenta.nombre_cuenta}</option>
                                    {else}
                                        <option value="{$cuenta.id_clase_cuenta},{$cuenta.id_grupo_cuenta},{$cuenta.id_cuenta_mayor},{$cuenta.id_cuenta}">{$cuenta.id_clase_cuenta}.{$cuenta.id_grupo_cuenta}.{$cuenta.id_cuenta_mayor}.{$cuenta.id_cuenta} {$cuenta.nombre_cuenta}</option>
                                    {/if}
                                {/foreach}
                            </select>
                        </div> 
                        
                        <div class="form-group">
                            <label for="sel1">Atributo especial:</label>
                            <div class="checkbox">
                                <label><input type="checkbox" name="es_desinversion">Cuenta desinversion</label>
                            </div>
							<div class="checkbox">
                                <label><input type="checkbox" name="es_capitalemp">Cuenta capital empresa</label>
                            </div>
							<div class="checkbox">
                                <label><input type="checkbox" name="es_utilidadret">Cuenta utilidad retenida</label>
                            </div>
                        </div> 
                        
                        <button type="submit" class="btn btn-success">Crear cuenta</input>
                    </div>
                </div>
            </form>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="{$base_url}js/bootstrap.min.js"></script>
    </body>
</html>
