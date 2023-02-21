<!DOCTYPE html>
<html>
	<?php require("header.php");?>
      </div></div>
      </div>
        <ul class="nav nav-justified nav-tabs ">
          <li ><a href="index.php"><h3>Featured</h3></a></li>
          <li class="active"><a  type ="button" href="#" class="red"><h3>Top</h3></a></li>
          <li ><a type ="button"  href="new.php"><h3>New</h3></a></li>
          <li><a type ="button" href="Create.php"><h3>Create</h3></a></li>
          <li><a type ="button" href="Bookmarks.php"><h3>Bookmarks</h3></a></li>
        </ul>
  </div>   
     
        
     
  

    <div class="container">
    <?php 
     require("common.php"); 

      $query = " 
              SELECT * FROM stories
              ORDER BY edits DESC
              LIMIT 10;
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
     

              };           
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
