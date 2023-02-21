<!DOCTYPE html>
<html>
    <?php require("header.php");?>
	<?php 
	 if(empty($_SESSION['user'])) 
	  {
		  header("Location: login.php");
	  }
	?>	
		</div></div>
      </div>
	     <ul class="nav nav-justified nav-tabs ">
          <li ><a href="index.php" ><h3>Featured</h3></a></li>
          <li><a type ="button" href="Top.php"><h3>Top</h3></a></li>
          <li><a type ="button" href="New.php"><h3>New</h3></a></li>
          <li><a type ="button" href="Create.php"><h3>Create</h3></a></li>
          <li class="active"><a type ="button" href="#" class="red"><h3>Bookmarks</h3></a></li>
        </ul>
  </div>   


    <button class="button_small btn-active visible-xs col-xs-12">
		<h3 class=""><a shref="#" style="color:rgb(194,65,45)">Log-in</a></h3></button>

    <div class="container">
    
	
	<?php 
	 
     require("common.php"); 

		
        $query_params = array(
        ':USERNAME' => $_SESSION['user']['username'],
        );
         
	  
	  $loops=0;
      
      $query = " 
              SELECT * FROM bookmarks
              WHERE username=:USERNAME
              ORDER BY new_date DESC
              ";
             
            try 
            { 
                // These two statements run the query against your database table.			
				 $stmt = $db->prepare($query); 
				$result = $stmt->execute($query_params);

                while($row = $stmt->fetch())
                {
                  $t=$row['title'];
                 

                    Print ("<div class='col-md-12  margintop'>
                      <h1 class='col-md-4'><a type ='button' href='Read.php?Story=".htmlspecialchars($t, ENT_QUOTES)."&Page=".$row['page']." '> ".$t."</a></h1>
                      <p class='col-md-7  well margintop'>Page ".$row['page']."</p>
					  <button onclick='location.href = &quot; DeleteBookmark.php?id=".$row['id']." &quot;; '> X </button>
                      </div>
                  ");
				  
				  
				  
				  $loops=$loops+1;
              };
				if($loops==0){
					Print ("<div class='col-md-12  margintop'>
                      <h1 class='col-md-4'>Nothing found :( </h1>
                      <button> X </button>
					  </div>
                  ");
				}
        }
            catch(PDOException $ex) 
            {
                // Note: On a production website, you should not output $ex->getMessage(). 
                // It may provide an attacker with helpful information about your code.
                echo mysql_error();
                die("b)Failed to run query: " . $ex->getMessage()); 
            }
    ?>
    </div>

		
  	</body>
	
	
</html>