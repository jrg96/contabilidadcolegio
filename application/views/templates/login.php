<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tramites legales - bufete alvarado</title>
    <link href="{$base_url}bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="{$base_url}css/style.css" rel="stylesheet">
    <link href="{$base_url}font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>

  <body>
    <!-- Barra de navegacion de sistema gestor -->
	<nav class="navbar navbar-inverse navbar-fixed-top navbar-md">
		<div class="container">
		    <div class="container-fluid">
		        <div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-left navbar-brand navbar-logo" href="index.html">
						<a class="navbar-brand font-big" href="">Bufete Alvarado</a>
					</a>
		        </div>
				
				<div id="navbar1" class="navbar-collapse collapse">
				</div>
				<!--/.nav-collapse -->
			</div>
		<!--/.container-fluid -->
		</div>
    </nav>

    <div class="container">
	
	<form action="/sic115/index.php/login/procesar" method="post">
        
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
            
                {if $resultado_operacion neq 'ninguna'}
				<div class="alert alert-success">
					<strong>{$resultado_operacion}</strong> {$mensaje_operacion}
				</div>
				{/if}
                
                
				<!--Panel de inicio de sesion-->
				<div class="panel panel-primary">
					<div class="panel-heading">
						<center class="panel-title">
							Inicio de sesión
						</center>
					</div>
					
					<br />
					
					<div class="panel-body">
					    <div class="row">
							<div class="col-md-1"></div>
							<div class="col-md-10">
								<div class="row">
								    <div class="col-xs-1">
									    <i class="fa fa-user fa-3x"></i>
									</div>
									<div class="col-xs-11">
									    <input type="text" class="form-control input-lg" placeholder="example@email.com" id="txtEmail" name="txtEmail"/>
									</div>
								</div>
								
								<br />
								
								<div class="row">
								    <div class="col-xs-1">
									    <i class="fa fa-lock fa-3x"></i>
									</div>
									<div class="col-xs-11">
									    <input type="password" class="form-control input-lg" placeholder="Contraseña" id="txtContrasenia" name="txtContrasenia"/>
									</div>
								</div>
							</div>
							<div class="col-md-1"></div>
						</div>
					</div>
					
					<br />
					<br />
					
					<div class="panel-footer no-vertical-padding">
					    <div class="row">
						    <div class="col-xs-12 side-padding-zero">
							    <input type="submit" class="btn btn-success btn-block btn-lg no-rounded-corner" value="Iniciar sesión"></input>
							</div>
						</div>
					</div>
				</div>
				<!--Panel de inicio de sesion-->
			</div>
			<div class="col-md-2"></div>
		</div>
		
    </form>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{$base_url}js/jquery-3.2.1.min.js"></script>
    <script src="{$base_url}bootstrap/js/bootstrap.js"></script>
  </body>
</html>