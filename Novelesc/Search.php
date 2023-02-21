<!DOCTYPE html>
<html>

	  <?php require("header.php");?>
	  
	  

	  	</div></div>
	  	</div>
	      <ul class="nav nav-justified nav-tabs ">
          <li><a type ="button" href="index.php"><h3>Featured</h3></a></li>
          <li><a type ="button" href="Top.php"><h3>Top</h3></a></li>
          <li><a type ="button" href="New.php"><h3>New</h3></a></li>
          <li><a type ="button" href="Create.php"><h3>Create</h3></a></li>
          <li><a type ="button" href="Bookmarks.php"><h3>Bookmarks</h3></a></li>
        </ul>
	</div>

  <div class="container">
    <?php 
     require("common.php"); 
		
      $query = " 
              SELECT
              stories.title,
              stories.author,
              stories.Descrip
              FROM 
              stories
              WHERE
              stories.title LIKE '%".$_GET["search"]."%' OR  
              stories.author LIKE '%".$_GET["search"]."%' OR
              stories.Descrip LIKE '%".$_GET["search"]."%';
            ";
             
            try 
            { 
                // These two statements run the query against your database table.
				$loops=0;
                $result = $db->query($query);
                while($row = $result->fetch())
                {
                  $t=$row['title'];
                  Print ("<p class='row nav-justified'><a href='Read.php?Story=".htmlspecialchars($t, ENT_QUOTES)."'>".$t."</a></p>");
				  $loops=$loops+1;
				}

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
                //echo mysql_error();
                die("b)Failed to run query: " . $ex->getMessage()); 
            }
			
			

    ?>
    </div>
</body>
</html>