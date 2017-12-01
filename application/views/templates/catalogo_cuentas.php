<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Starter Template for Bootstrap</title>
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
                                </tr>
                            </thead>
                            
                            <tbody>
                                {foreach item=cuenta from=$cuentas}
                                <tr>
                                    <th><center>{$cuenta.id_clase_cuenta}.{$cuenta.id_grupo_cuenta}.{$cuenta.id_cuenta_mayor}.{$cuenta.id_cuenta}</center></th>
                                    <th><center>{$cuenta.nombre_cuenta}</center></th>
                                    <th><center>{$cuenta.clase_cuenta} {$cuenta.abreviatura_clase_cuenta}</center></th>
                                    <th><center><a href="/sic115/index.php/modificarcuenta/index/{$cuenta.id_cuenta_interno}">Actualizar</a></center></th>
                                    <th><center><a href="/sic115/index.php/vertransaccionescuenta/index/{$cuenta.id_cuenta_interno}">Consultar</a></center></th>
                                </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="{$base_url}js/bootstrap.min.js"></script>
    </body>
</html>
