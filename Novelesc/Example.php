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

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="CSS.css" rel="stylesheet">
    <title>Interactive Fan Fiction</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body >
  	<div class="background">
	   <div class="masthead">
      <nav class="navbar-header">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-default">
        <a class="navbar-brand navbar-header" href="#"><h1>IFF</h1></a>
       </div>
    </nav>
  </div>

	    <!--Search bar-->
	    <div class="navbar">
	   	<div class="input-lg padtop">

		    <form  role="search">
		      <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-4 ">
		        <input type="text" class="form-control input-lg" placeholder="Search"></div>
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
      </div>";
      }
      ?>

     

	  	</div>
	  	</div>
	   
	      <ul class="nav nav-justified nav-tabs ">
          <li><a href="index.php"><h3>Featured</h3></a></li>
          <li><a type ="button" href="Top.php"><h3>Top</h3></a></li>
          <li><a type ="button" href="New.php"><h3>New</h3></a></li>
          <li><a type ="button" href="Create.php"><h3>Create</h3></a></li>
          <li><a type ="button" href="Bookmarks.php"><h3>Bookmarks</h3></a></li>
        </ul>
	</div>	 


<div class="container">
  <div class="row">
    <h1>Story Title</h1>
  </div>
  <div class="row">
    <p>
    The standard Lorem Ipsum passage, used since the 1500s

"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."

Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC

"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"

1914 translation by H. Rackham

"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"

Section 1.10.33 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC

"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."

1914 translation by H. Rackham

"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."
    </p>

<a type ="button" class="background-purple" href="#"><h2>put the document down.</h2></a>

<a type ="button" class="background-purple" href="#"><h2>ball up the paper and try to throw it into the trash bin.</h2></a>

  </div>
  <div class="row">
    <div class="col-md-9">
      <input type="text" class="form-control input-lg" placeholder="Add your own: Text goes here">
    </div>
    <div class="col-md-3">
      <a class="btn" href="#">submit</a></button>
    </div>
  </div>
<div class="row">
  <div class="col-md-3">
    <select class="form-control">
      <option>On click</option>
      <option>If reader has flag</option>
      <option>If reader doesn't have flag</option>
    </select>
  <input type="text" value="" />
  </div>

  <div class="col-md-3">
    <select class="form-control">
      <option>nothing</option>
      <option>set new flag</option>
      <option>remove flag</option>
      <option>go to page</option>
      <option>hide this option</option>
      <option>show this option</option>
       <input type="text" value="" />
    </select>

  </div>
  <div class="col-md-3">
     <select class="form-control">
      <option>nothing</option>
      <option>else</option>
      <option>set new flag</option>
      <option>remove flag</option>
      <option>go to page</option>
      <option>hide this option</option>
      <option>show this option</option>
       <input type="text" value="" />
    </select>
  </div>
  <div class="col-md-3">
     <select class="form-control">
      <option>nothing</option>
      <option>set new flag</option>
      <option>remove flag</option>
      <option>go to page</option>
      <option>hide this option</option>
      <option>show this option</option>
       <input type="text" value="" />
    </select>
  </div>
</div>
<div class="row">
  .+++++++++++++++++++++++++
</div>
    <button class="btn btn-active visible-xs col-xs-12">
		<a class="btn active" href="#">Log-in</a></button>  
  	</body>
</html>