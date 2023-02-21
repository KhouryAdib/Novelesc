<!DOCTYPE html>
<html>

<?php require("header.php");?>
<?php 
 if(empty($_SESSION['user'])) 
  {
	  header("Location: login.php");
  }
?>
<body>
      </div></div>
      </div>
         <ul class="nav nav-justified nav-tabs ">
          <li><a type ="button" href="index.php"><h3>Featured</h3></a></li>
          <li><a type ="button" href="Top.php"><h3>Top</h3></a></li>
          <li><a type ="button" href="New.php"><h3>New</h3></a></li>
          <li class="active"><a type ="button" href="#" class="red"><h3>Create</h3></a></li>
          <li> <a type ="button" href="Bookmarks.php"><h3>Bookmarks</h3></a></li>
        </ul>
  </div>   


   
<!--/header-->
      <div class="containter input-lg padtop">
        <div>
          <form  role="search" method="POST" action='Createstory.php'>
            <div class="form-group col-xs-10 col-sm-6 col-md-6 col-lg-6 ">
              <input type="text" name="Title" class="form-control input-lg" placeholder="Story Title">
              <input type="text" name="desc" class="form-control margintop input-lg" placeholder="Description">
              <textarea type="text" name="Story" class="col-md-12 margintop panel-body input-lg" rows="5" placeholder="  Story Text"></textarea>
              
            </div>
              <button type="submit" value="My Button" class=" btn btn-default btn-lg ">Create Story</button> 
          </div>
        </form>
        </div>
      
  	</body>

<!--This makes drop downs change to their value-->



    </script>
</html>