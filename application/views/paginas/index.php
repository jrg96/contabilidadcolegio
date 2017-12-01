<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Starter Template for Bootstrap</title>
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.css" rel="stylesheet">
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
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            
            <div class="col-md-8">
                <div class="row">
                    <center><h2>Contabilidad - Colegio</h2></center>
                    <br />
                </div>
                <div class="row vertical-center">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-sign-in fa-5x"></i>
                    </div>
                    <div class="col-md-5">
                        <a href="/sic115/index.php/login/index" class="btn btn-primary btn-block btn-lg no-rounded-corner">Iniciar Sesión</a>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
            
            <div class="col-md-2">
            </div>
        </div>
    </div><!-- /.container -->



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    </body>
</html>
