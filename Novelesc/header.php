<!DOCTYPE html>
<html>
<!--head-->
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Adib Khoury">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <link href='http://fonts.googleapis.com/css?family=ABeeZee|Cutive' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="CSS.css" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	
    <?php 

			if (isset($_GET['Story']))
			{
				print "<title>".$_GET['Story']."</title>";
			}
			else
			{
				print "<title>Novelesc</title>";
			}
			?>
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body >
    <div class="nav">
     <div class="masthead row ">
      <nav class="navbar-header col-md-3">
      <div class="navbar-default">
        <a class="navbar-brand navbar-header" href="index.php"><div id="masthead">Novelesc</div></a>
       </div>
    </nav>


      <!--Search bar-->
      <div class="">
      <div class="input-lg padtop ">

        <form  role="search" action="search.php" method="get">
          <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4 ">
		  
			<?php 				
			if (isset($_GET['search']))
			{
				print "<input type='text' class='form-control input-lg' name='search' placeholder=".$_GET['search']."></div>";
			}
			else
			{
				print "<input type='text' class='form-control input-lg' name='search' placeholder='Search'></div>";
			}
			?>
			
          <button type="submit" class="btn btn-default btn-lg col-xs-2 col-lg-1">Go</button> 
        </form>
		
        <!--Log in-->
      <?php
       require("common.php"); 
      if(!empty($_SESSION['user'])) 
      {
       
       print "<div class='nav navbar-right '><a href='private.php'><h4>Welcome, ";
       echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');
       print "</h4></a></div>";
      }
      else
      {
        print " <div class='nav hidden-xs'>
        <button type='submit' class='btn-lg navbar-right btn-inverse'><a href='login.php'>Log-in</a></button>
      </div><button class='btn btn-active visible-xs col-xs-12'>
    <a class='btn active' href='#'>Log-in</a></button>'";
      }
      ?>

</body>
</html>  