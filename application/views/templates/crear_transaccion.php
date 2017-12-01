<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crear transaccion</title>
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
                                {foreach item=cuenta from=$cuentas}
                                    <option value="{$cuenta.id_cuenta_interno},{$cuenta.id_clase_cuenta},{$cuenta.id_grupo_cuenta},{$cuenta.id_cuenta_mayor},{$cuenta.id_cuenta}">{$cuenta.id_clase_cuenta}.{$cuenta.id_grupo_cuenta}.{$cuenta.id_cuenta_mayor}.{$cuenta.id_cuenta} {$cuenta.nombre_cuenta} {$cuenta.abreviatura_clase_cuenta}</option>
                                {/foreach}
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
                                {foreach item=cuenta from=$cuentas}
                                    <option value="{$cuenta.id_cuenta_interno},{$cuenta.id_clase_cuenta},{$cuenta.id_grupo_cuenta},{$cuenta.id_cuenta_mayor},{$cuenta.id_cuenta}">{$cuenta.id_clase_cuenta}.{$cuenta.id_grupo_cuenta}.{$cuenta.id_cuenta_mayor}.{$cuenta.id_cuenta} {$cuenta.nombre_cuenta} {$cuenta.abreviatura_clase_cuenta}</option>
                                {/foreach}
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



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="{$base_url}js/bootstrap.min.js"></script>
        <script src="{$base_url}js/crear_transaccion.js"></script>
    </body>
</html>
