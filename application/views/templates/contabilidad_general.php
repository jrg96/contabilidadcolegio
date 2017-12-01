<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contabilidad general</title>
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
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
                <h1>Acciones a realizar</h1>
                
                <div class="panel panel-primary">
                    <div class="panel-heading">Configuracion del sistema</div>
                    <div class="panel-body">
                        <a href="/sic115/index.php/configuracion" class="btn btn-info" role="button">Configuracion general</a>
                    </div>
                </div>
                
                <div class="panel panel-primary">
                    <div class="panel-heading">Mantenimiento general</div>
                    <div class="panel-body">
                        <a href="/sic115/index.php/crearcuenta" class="btn btn-info" role="button">Crear cuenta</a>
                        <a href="/sic115/index.php/catalogocuentas" class="btn btn-info" role="button">Catalogo de cuentas</a>
                        
                        <br />
                        <br />
                        
                        <a href="/sic115/index.php/creartransaccion" class="btn btn-info" role="button">Crear transaccion</a>
                    </div>
                </div>
                
                <div class="panel panel-primary">
                    <div class="panel-heading">Periodo contable</div>
                    <div class="panel-body">
                        <a href="/sic115/index.php/crearperiodocontable" class="btn btn-info" role="button">Crear periodo contable</a>
                        <a href="/sic115/index.php/verestadosfinancieros" class="btn btn-info" role="button">Estados financieros</a>
                    </div>
                </div>
				
				<div class="panel panel-primary">
                    <div class="panel-heading">Empleados</div>
                    <div class="panel-body">
                        <a href="/sic115/index.php/crearempleado/index" class="btn btn-info" role="button">Crear empleado</a>
                        <a href="/sic115/index.php/listaempleados/index" class="btn btn-info" role="button">Ver lista de empleados</a>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    </body>
</html>