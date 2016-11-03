<?php 
session_start();
if ($_SESSION["XuserID"]==""){
    header("location:login.php");
}
include("config.php");
$modulo=$modulo_def;
if ($_REQUEST["mod"]!=""){
	$modulo=$_REQUEST["mod"];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $titulo;?></title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="libs/table/bootstrap-table.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-combobox.css" rel="stylesheet">
        <link href="css/bootstrap-editable-table.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- jQuery Version 1.11.1 -->
<script src="js/jquery.js"></script>
<script src="js/jquery.form.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="libs/table/bootstrap-table.js"></script>
<script src="js/bootstrap-editable-table.js"></script>
<script src="libs/table/locale/bootstrap-table-es-AR.min.js"></script>
<script src="js/bootstrap-combobox2.js"></script>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?php echo $titulo;?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php 
                for ($i=0;$i<count($modulos);$i++) {
                    echo'<li>
                        <a href="?mod='.$modulos[$i].'">'.$modulos_desc[$i].'</a>
                    </li>';
                }
                
                ?>
                 </ul>
                  <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-lock"></i> Admin <i class="caret"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="salir.php">Salir<i class="icon-lock"></i></a></li>
                    </ul>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
    <?php 
    include("modulos/".$modulo."/index.php");
    ?>	
    </div>
    <!-- /.container -->



</body>

</html>
