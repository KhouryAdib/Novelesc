<!DOCTYPE html>
<html>
	<?php require("header.php");?>
	<body>
      </div></div>
      </div>
        <ul class="nav nav-justified nav-tabs ">
          <li class="active"><a href="#" class="red"><h3>Featured</h3></a></li>
          <li ><a  type ="button" href="Top.php" ><h3>Top</h3></a></li>
          <li ><a type ="button"  href="new.php"><h3>New</h3></a></li>
          <li><a type ="button" href="Create.php"><h3>Create</h3></a></li>
          <li><a type ="button" href="Bookmarks.php"><h3>Bookmarks</h3></a></li>
        </ul>
  </div>   
     
        

	
    <div class="container">
    <?php 
	 
     require("common.php"); 
	  $loops=0;
      $date=date('Y-m-d', strtotime('-1 week'));
      $query = " 
              SELECT * FROM stories
              WHERE CreatedOn >='".$date."'
              ORDER BY edits DESC
              LIMIT 10 
              ";
             
            try 
            { 
                // These two statements run the query against your database table.

                $result = $db->query($query);

                while($row = $result->fetch())
                {
                  $t=$row['title'];
                 

                    Print ("<div class='col-md-12  margintop'>
                      <h1 class='col-md-4'><a type ='button' href='Read.php?Story=".htmlspecialchars($t, ENT_QUOTES)."'> ".$t."</a></h1>
                      <p class='col-md-7  well margintop'>".$row['Descrip']."</p>
                      </div>
                  ");
				  $loops=$loops+1;
              };
				if($loops==0){
					Print ("<div class='col-md-12  margintop'>
                      <h1 class='col-md-4'>Nothing found :( </h1>
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
