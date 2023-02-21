<!DOCTYPE html>
<html>
<?php require("header.php");?>
	  	</div></div>
	  	</div>
	     <ul class="nav nav-justified nav-tabs ">
          <li ><a type ="button" href="index.php"><h3>Featured</h3></a></li>
          <li><a type ="button" href="Top.php"><h3>Top</h3></a></li>
          <li><a type ="button" href="New.php"><h3>New</h3></a></li>
          <li><a type ="button" href="Create.php"><h3>Create</h3></a></li>
          <li> <a type ="button" href="Bookmarks.php"><h3>Bookmarks</h3></a></li>
        </ul>
	</div>	 
	
	<div class="container">
		  
	<?php
		    if (isset($_GET['Story'])&&isset($_GET['Page']))
		    {
		    	
		    	$title=$_GET['Story'];
		    	$Page=abs($_GET['Page']);
			
			//this determines if the page exsits and redirects if it doesn't
			$query = " 
				SELECT 
				Pages 
				FROM stories 
				Where title = '".htmlentities($title, ENT_QUOTES, 'UTF-8')."'
			";
			 
			try 
			{ 
				// These two statements run the query against your database table.

				$result = $db->query($query);
				$row = $result->fetch();
				if($row['Pages']<$Page){header("location: 404.php?message=Page not found");}

			} 
			catch(PDOException $ex) 
			{
				// Note: On a production website, you should not output $ex->getMessage(). 
				// It may provide an attacker with helpful information about your code.
				//echo mysql_error();   
				die("derp)Failed to run query: ".$ex->getMessage());
			}
			
			
			
			//if user logged in, setup bookmarks
			//this will break non logged in users experience.
			//maybe non-logged in users use cookies.
			if(!empty($_SESSION['user']))
			{
				//get current options, if not exist create new bookmark row
				$query = " 
				Select 1 from bookmarks where username = :username and title = :title and focused = true;
				";

				$query_params = array(
				':username' => $_SESSION['user']['username'],
				':title' => $title
				);
				
				try 
				{
					// Execute the query to create the story 
					$stmt = $db->prepare($query); 
					$result = $stmt->execute($query_params);
					
					//if user has a bookmark
					if($stmt->rowCount() > 0){
						
							//if option is set add it to the bookmark
							if(isset($_POST['option'])){
								
								$option=$_POST['option'];
								
								
								
									$row = $stmt->fetch();
									//$bookmarks=$row["bookmark"];
									//print "bookmark found ".$bookmarks;
								
								$query = " 
									Update bookmarks
									Set bookmark = CONCAT(bookmark,' ', :option)
									where focused = :focused
									and username = :username
									and focused = :focused
									and title = :title;
									
								   ";
					   
								$query_params = array(
								':username' => $_SESSION['user']['username'],
								':option' =>  $option,
								':title' => $title,
								':focused' => true
								);
								
								try 
								{ 
									// Execute the query to create the story 
									$stmt = $db->prepare($query); 
									$result = $stmt->execute($query_params);
								}
								catch(PDOException $ex) 
								{
									// Note: On a production website, you should not output $ex->getMessage(). 
									// It may provide an attacker with helpful information about your code.  
									die("4)Failed to run query: " . $ex->getMessage()); 
								}
							}//if it is not set, the user is comming from their own bookmark so dont add it.
							
							
						//here i would create a bookmarks array to get the flags, then get the array of subracted flags then subtract the ones that should be subtracted.
						
						
						
						
						
					}
					else{//if no bookmark found
					
					
							print "created new bookmark";
							$query = " 
							INSERT INTO bookmarks(
							username,
							title,
							flags,
							history,
							page, 
							focused
							) VALUES (
							:username,
							:title,
							:flags,
							:history,
							:page, 
							:focused
							);		
						   ";
			   
						$query_params = array(
						':username' => $_SESSION['user']['username'],
						':flags' =>  "",
						':history' => "",
						':title' => $title,
						':page' => $Page,
						':focused' => true
						);
						
						try 
						{ 
							// Execute the query to create the story 
							$stmt = $db->prepare($query); 
							$result = $stmt->execute($query_params);
						}
						catch(PDOException $ex) 
						{
							// Note: On a production website, you should not output $ex->getMessage(). 
							// It may provide an attacker with helpful information about your code.  
							die("4)Failed to run query: " . $ex->getMessage()); 
						}
						
						
					}
					
					
					

				}
				catch(PDOException $ex) 
				{
					// Note: On a production website, you should not output $ex->getMessage(). 
					// It may provide an attacker with helpful information about your code.  
					die("b5)Failed to run query: " . $ex->getMessage()); 
				}
				
				
			}	
				
			//save bookmarks
			
			//check if has bookmark
				//if not go to first page and create a focused bookmark for the first page.
				
				//else add the last optionID to the list of bookmarks if the current 
				
				//
			
			
		/*	$query = " 
            UPDATE bookmarks
			SET(			
                username,
				bookmark,
				page,
				new_date
            ) VALUES ( 
                :username, 
                :bookmark, 
                :page,
				:date
            )
			
			BEGIN
			   IF NOT EXISTS (SELECT * FROM bookmarks 
							   WHERE username = :username
							   AND page = :page
							   AND bookmarks = bookmark)
			   BEGIN
				   INSERT INTO EmailsRecebidos (De, Assunto, Data)
				   VALUES (@_DE, @_ASSUNTO, @_DATA)
			   END
			END

			";
                  
         
        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store 
        // the salt (in its plaintext form; this is not a security risk). 

        $query_params = array(
        ':username' => $_SESSION['user']['username'],
        ':bookmark' =>  ,
        ':page' => $Page,
		':date' => null
        );
        
        try 
        { 
            // Execute the query to create the story 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params);
        }
        catch(PDOException $ex) 
        {
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("4)Failed to run query: " . $ex->getMessage()); 
        }
				
				
		*/		
			}
		    else if (isset($_GET['Story'])){
		    	$title=$_GET['Story'];
		    	$Page=0;
		    }
		    else
		    {
		    	 header('Location: index.php');
		    }
		    
		    //see if the story exists
		    $query = " 
	            SELECT 
	                1 
	            FROM stories 
	            WHERE 
	                title = :title 
	        ";
	        $query_params = array( 
	            ':title' => $title 
	        ); 
	         
	        try 
	        { 
	            // These two statements run the query against your database table. 
	            $stmt = $db->prepare($query); 
	            $result = $stmt->execute($query_params); 
	        } 
	        catch(PDOException $ex) 
	        { 
	            // Note: On a production website, you should not output $ex->getMessage(). 
	            // It may provide an attacker with helpful information about your code.  
	            die("a)Failed to run query: " . $ex->getMessage());
	        } 
	         
	        // The fetch() method returns an array representing the "next" row from 
	        // the selected results, or false if there are no more rows to fetch. 
	        $row = $stmt->fetch(); 
	         
	        // If a row was returned, then we know a matching username was found in 
	        // the database already and we should not allow the user to continue. 

  					
	        if($row) 
	        {  
	        	$query = " 
		            SELECT 
		            Pages 
		            FROM stories 
		            Where title = '".htmlentities($title, ENT_QUOTES, 'UTF-8')."'
		        ";
		         
		        try 
		        { 
		            // These two statements run the query against your database table.

		            $result = $db->query($query);
		            $row = $result->fetch();
		            if($row['Pages']<$Page){header("location: 404.php?message=Page not found");}

				} 
		        catch(PDOException $ex) 
		        {
		            // Note: On a production website, you should not output $ex->getMessage(). 
		            // It may provide an attacker with helpful information about your code.
		            //echo mysql_error();   
		            die("b)Failed to run query: ".$ex->getMessage());
		        }

		        $query = " 
		            SELECT 
		            * 
		            FROM stories.`".$title."_story` 
		            Where pageID=".$Page." ";
		        
		        try 
		        { 
		            // These two statements run the query against your database table.

		            $result = $db->query($query);
					$row = $result->fetch();
					
		            print("<div class='row'><h1>".$title."</h1></div>");
					Print "<p class='col-sm-10'><i>".$row['Text']."</i></p>";
					if(!empty($_SESSION['user'])) 
								{
					if($row['author']==htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8')){
						Print "<a class='btn col-sm-1 btn-default '> Edit option</a>";
					}
								}
		            //outputs the story text
		            while($row = $result->fetch())
		            {
						Print "<p class='row'> </p>";
		            	switch ($row['picture']) {
		            		
							case '0':
								//Print "<p class='row'>".$row['Text']."</p>";
		            			
								break;
		            		case '1':
		            			Print "<p class='col-sm-10'><img  class='img-responsive' src=upload/".$row['Text']."></p>";
								if(!empty($_SESSION['user'])) 
								{
									if($row['author']==htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8')){
									//Print "<p class='btn col-md-1 btn-default '> Delete </p>";								
									}
								}
								/*
								i need to give these delete buttons an id that represents the story text they are connected to.
								therefore i should change the story table to include a number to represent each line.
								since i cannot edit or delete the options without it looking bad, let the delete/exit button for the first story post also effect the option behind it.
								
								*/
		            			break;
								default: Print "<p class='col-sm-10'>".$row['Text']."</p>";
								if(!empty($_SESSION['user'])) 
								{
									if($row['author']==htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8')){
										Print "<a class='btn col-sm-1 btn-default '> Edit </a>";
										//Print '<a class="btn col-md-1 btn-default" href="deleteStory.php?Story='.$title.'&Page='.$Page.'&subID='.$row['subID'].' "> Delete </a>';
									}
								}
								
		            			break;
		            	} 
		            	
		        	}           
				} 
		        catch(PDOException $ex) 
		        {
		            // Note: On a production website, you should not output $ex->getMessage(). 
		            // It may provide an attacker with helpful information about your code.
		            //echo mysql_error();   
		            die("Something went terribly wrong:" . $ex->getMessage()); 
		        }

		        $query = " 
		            SELECT 
		            * 
		            FROM stories.`".$title."_option` 
		            Where pageID=".$Page."
		        ";
		         
		        try 
		        {
		            // These two statements run the query against your database table.

		            $result = $db->query($query);

		          	//outputs the options
		            while($row = $result->fetch())
		            {
						if($row['VisibleWithFlag']==''){
							//Print "<a type ='button' id='deleteButton' name='deleteButton' class='background-purple' href='read.php?Story=".$title."&Page=".$row['targetPage']."&Option=".$row['optionID']."'><h2 class='size'>".$row['Text']."</h2></a>";<h2 class='size'>".$row['Text']."</h2>
							Print "<form method='post' action = 'read.php?Story=".$title."&Page=".$row['targetPage']."' class='btn btn-default col-sm-5' '><h2 ><button type='submit' ><input type='hidden' name='option' id='option' value=".$row['optionID']." >".$row['Text']."</button></h2></form>";
						}
		        	}
				}
		        catch(PDOException $ex) 
		        {
		            // Note: On a production website, yo
					//u should not output $ex->getMessage() .
		            // It may provide an attacker with helpful information about your code.
		            echo mysql_error();   
		            die("b)Failed to run query: ".$ex->getMessage()); 
		        }
	        }
	        else
	        {
	        	die($title." doesn't exist!");         
	        }
			
			
			
?>
	<div class="btn-group" data-toggle="buttons">
	<?php
	if(!empty($_SESSION['user'])) 
    {
		print "
		<button type='radio' href='#bottom' class='link btn btn-default btn-lg' data-toggle='tooltip' data-placement='top' title='This lets you continue the current page. Your text is added underneath the last paragraph.' id='storybutton'>add to the story</button> 
		<button type='radio' href='#bottom' class='link btn btn-default btn-lg' data-toggle='tooltip' data-placement='top' title='This adds an option to the bottom of the page and lets you branch off the story.' id='optionbutton'>add an option</button>
		<button type='radio' onclick=\"location.href='SaveBookmark.php?Story=".$title."&Page=".$Page."' \" class=' btn btn-default btn-lg'  id='bookmark'>bookmark this page</button>
		<button type='radio' href='#bottom' class=' btn btn-default btn-lg'  id='help'>help</button>
		"; 
	}
	?>
	
	</div>
		<div >
	        <div class="col-md-12 input-lg padtop hidden" id="addStory">
	          <?php print ("<form  role='search' method='POST' action='AddStory.php?Story=".$title."&Page=".$Page."'>") ?>
	            <div class="form-group col-xs-10 col-sm-8 col-md-8 col-lg-8 ">
	              <textarea type="text" name="stext" id="stext" class="col-md-12 input-lg" rows="4" placeholder="Story Text"></textarea>
	                                 
	              <input type="text" id="StoryFlag" name="StoryFlag" class="btn-group input-lg hidden" placeholder="Flag name">
	            </div>
	              <button type="submit" name="storySubmit" id="storySubmit" class="btn btn-default btn-lg ">Submit</button>
	             
	        </form>
			<button type="" name="upload" id="upload" class="btn btn-default margintop btn-lg ">or you can upload a file instead!</button> 
	       </div>
		   <?php print ('<form method="post" id="uploadtable" class="hidden" action="upload2.php?Story='.htmlentities($title, ENT_QUOTES, 'UTF-8').'&Page='.$Page.'" enctype="multipart/form-data">') ?>
			<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
			<tr>
			<td width="246">
			<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
			<?php print ("<input type='hidden' name='Story' id='Story' value='".$title."'><input type='hidden' name='Page' id='Page' value='".$Page."'> ") ?>
			<input name="file" type="file" id="file"> 
			</td>
			<td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
			</tr>
			</table>
			</form>
	    </div>
	    <div class="input-lg padtop hidden" id="addOption">
			<div class="row col-md-8">
			
	        <div>
	          <?php
	          print ("<form  role='search' method='POST' action='AddStory.php?Story=".htmlentities($title, ENT_QUOTES, 'UTF-8')."&Page=".$Page."'>") ?>
	            <div class="form-group">
	               <input type="text" name="otext" id="stext" class="form-control input-lg" placeholder="Option Text">
	           

	           
	           <!--<select type="button" name="OptionCommand" id="OptionCommand" class="btn margintop btn-lg dropdown-toggle" data-toggle="dropdown">               
	                  <option value="1" href="#">Show option if has token:</option>
	                  <option value="2" href="#">Show option if doesn't have token:</option>
					  <option value="3" href="#">Go to existing page:</option>
	                  <option selected value="0" href="#">Go to new page:</option>                
	              </select>
	             --> 
	          
	              <input type="text" id="OptionFlag" name="OptionFlag" class="margintop btn-group input-lg hidden" placeholder="Flag name"> 
	              
	            </div>
	            </div>
				
	            <div id="demo" class=" collapse out" > 
				<button type='button' href='#bottom' class=' btn btn-default btn-sm col-sm-1'  id='help'>?</button><div clas='col-lg-1'><p >Give token:         <input class='inner input-sm' placeholder='none' name="giveToken"/></p></div>
				<button type='button' href='#bottom' class=' btn btn-default btn-sm col-sm-1'  id='help'>?</button><div clas='col-lg-1'><p >Remove token:             <input class='inner input-sm' placeholder='none' name="removeToken"/> </p></div>
				<button type='button' href='#bottom' class=' btn btn-default btn-sm col-sm-1'  id='help'>?</button><div clas='col-lg-1'><p >Show option if has token: <input class='inner input-sm' placeholder='none' name="showOption" /> </p></div>
				<button type='button' href='#bottom' class=' btn btn-default btn-sm col-sm-1'  id='help'>?</button><div clas='col-lg-1'><p >Hide option if has token: <input class='inner input-sm' placeholder='none' name="hideOption" /></p></div>
				<button type='button' href='#bottom' class=' btn btn-default btn-sm col-sm-1'  id='help'>?</button><div clas='col-lg-1'><p >Go to specific page:      <input class='inner input-sm' placeholder='page number' name="targetPage" /></p></div>
				</div>
				
	           <button type="submit" class=" btn col-md-5 btn-default btn-lg ">Finish and submit options</button>
			   
	        	<input type="text" name="OptionCommand" id="OptionCommand" class="btn-group input-lg hidden" placeholder="hidden box">
	          </div>
	           <button type="button" class="marginleft btn-default btn-lg btn" data-toggle="collapse" data-target="#demo" >
				  Advanced Options
				</button>
				
	        <div class="row"></div>
	        </form>
	       </div>
	    </div>
	</div>
</body>

<script type="text/javascript">
        $('.link').tooltip()
     	//('#example').tooltip(options)

        $("#demo h2 a").click(function(){
       	
        	/*switch($(this).val())//where n = value of last thing inputted
			{
			case "1":
			     $('this:first-child').find('option')
			    .remove()
			    .end()
			    .append('<option value="whatever">test/option>')
			    .val('whatever'); break;
			    default:
			}*/
			$("#hiddenbox").val($("#hiddenbox").val()+$("#OptionCommand").val());
			
			if($("#stext").val()==null){
				$("storySubmit").addClass("hidden");
			}else{$("storySubmit").removeClass("hidden");}

			switch(this.id)
			{
			case "1": $( "#block" ).append("<div clas='col-md-12'><p class='col-md-12'>Give token: <input class='inner input-lg' placeholder='token name'> <a class='btn glyphicon glyphicon-remove-circle'> </a></p></div>");break;
			case "2": $( "#block" ).append("<div clas='col-md-12'><p class='col-md-12'>Show option if has token: <input class='inner input-lg' placeholder='token name'> <a class='btn glyphicon glyphicon-remove-circle'> </a></p></div>");break;
			case "3": $( "#block" ).append("<div clas='col-md-12'><p class='col-md-12'>Show option if doesn't has token: <input class='inner input-lg' placeholder='token name'><a class='btn glyphicon glyphicon-remove-circle'> </a></p></div>");break;
			case "4": $( "#block" ).append("<div clas='col-md-12'><p class='col-md-12'>Go to specific page: <input class='inner input-lg' placeholder='page number'><a class='btn glyphicon glyphicon-remove-circle'> </a></p></div>");break;
			case "5": $( "#block" ).append("<div clas='col-md-12'><p class='col-md-12'>Remove token: <input class='inner input-lg' placeholder='token name'> <a class='btn glyphicon glyphicon-remove-circle'> </a></p></div>");break;
        	}
        	switch(this.id)
			{


			}
			
			
//<input type="text" id="OptionFlag" name="OptionFlag" class="margintop btn-group input-lg hidden" placeholder="Flag name">
        });

		/* this was the old x button on the advanced options
		$(document).on("click","p a.glyphicon",function(){	
			$(this.parentNode).remove();
		});
    */
        $("#storybutton").click(function(){
       		
            $("#addStory").toggleClass("hidden");
            $("#addOption").addClass("hidden");
            $("#uploadtable").addClass("hidden");
        	
        });
        $("#optionbutton").click(function(){
       		
            $("#addOption").toggleClass("hidden");
        	$("#addStory").addClass("hidden");
        	$("#uploadtable").addClass("hidden");
        });

        $("#upload").click(function(){
       		
            $("#uploadtable").toggleClass("hidden");
        	$("#addStory").addClass("hidden");
        });

        $("#StoryCommand").click(function(){
       		
         if ($(this).val()=="0")
          {
            $('#StoryFlag').addClass("hidden");
          }
          else{
            $('#StoryFlag').removeClass("hidden");
          }});

		$("[href='#bottom']").click(function() {
		  $("html, body").animate({ scrollTop: $(document).height() }, "slow");
		  return false;
		});

		$(document).ready(function() {
			//$(".size").addClass("col-md-5");
				$(".size").addClass("col-md-5");
		});

    </script>



</html>


