<!DOCTYPE html>
<html>
<!--head-->
  <head>

  </head>
  <body>
<?php 

    // First we execute our common code to connection to the database and start the session
    require("common.php"); 

    if(!empty($_POST))
    {
    	$Page=$_GET['Page'];
		$title=htmlentities($_GET['Story'], ENT_QUOTES, 'UTF-8');
   	  	$t=str_replace ( "\'" , "\"" , $title );
		
		
			
    	$com="";
		$test=100;

		//here I determine if to add to the story table or the option table and set the tablename accordingly
	 		
		
		if(empty(trim($_POST['stext'])) && empty(trim($_POST['otext']))) {header("Location: 404.php?message='Text cannot be left blank.'"); die();}
		
	    if(isset($_POST['stext'])){$table="_story";$text=nl2br(htmlentities($_POST['stext'], ENT_QUOTES, 'UTF-8'));$command=$_POST['StoryCommand'] ?: '0';$flag=$_POST['StoryFlag'];

		}
	    else if (isset($_POST['otext'])){$table="_option";$text=nl2br(htmlentities($_POST['otext'], ENT_QUOTES, 'UTF-8'));$command=$_POST['OptionCommand'] ?: '0';$flag=$_POST['OptionFlag'];
		$giveToken = filter_var($_POST['giveToken'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
		$removeToken = filter_var($_POST['removeToken'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
		$showOption = filter_var($_POST['showOption'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
		$hideOption = filter_var($_POST['hideOption'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
		$targetPage = filter_var($_POST['targetPage'], FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
		
		}
		else{ header("Location: 404.php?message='2)Story and Page not set.'");}
	}
	else{ header("Location: 404.php?message='Story or Option text not set.'");}

	if (isset($_POST['stext']))
	{
		//this sets the subID in the story table by counting how many story entries are on a page.
		$row = $db->query("SELECT MAX(subID) FROM stories.`".$t."_story` WHERE pageID=".$Page." ")->fetchColumn();
				
    	 $query = "             
			INSERT INTO stories.`".$t."_story`(
                pageID,subID,author,text,command,VisibleWithFlag, HiddenWithFlag
            ) VALUES ( 
            	:PageID,:subID,:Author,:text,:command,:visibleWithFlag, :HiddenWithFlag
            );
			UPDATE stories SET edits = edits + 1 WHERE title='".$t."';
			
               ";
       
	        
        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store 
        // the salt (in its plaintext form; this is not a security risk). 
        $query_params = array(
        ':PageID' => $Page,
		':subID' => $row+1,
        ':Author' => $_SESSION['user']['username'],
        ':text' => $text,
        ':command' => $command,
        ':visibleWithFlag' => $flag,
		':HiddenWithFlag' => null
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
            die("1a)Failed to run query: " . $ex->getMessage()); 
        }
		
		header('Location: Read.php?Story='.$title.'&Page='.$Page);
	}
	
	if (isset($_POST['otext']))
	{
		//If the user selects a new option, find out the number of pages to find out where to send the user afterwords.
		if((strpos($command,0) === false)&&$targetPage===null)
		{
			$query = "	
				SELECT MAX(targetPage)
				FROM stories.`".$t."_option`
			";
			 
			try 
			{ 
				// These two statements run the query against your database table.
				$result = $db->query($query)->fetchColumn();
							
				$targetPage=$result+1;
			}
			catch(PDOException $ex) 
			{
				// Note: On a production website, you should not output $ex->getMessage(). 
				// It may provide an attacker with helpful information about your code.
				echo mysql_error();   
				die("c)Failed to run query: ".$ex->getMessage());
			}
		}
		//add to the option table
		$query_params = array(
		':PageID' => $Page,
		':Author' => $_SESSION['user']['username'],
		':text' => $text,
		':command' => $command,
		':visibleWithFlag' => $showOption,
		':HiddenWithFlag' => $hideOption,
		':giveToken' => $giveToken,
		':removeToken' => $removeToken,
		':targetPage' => $targetPage
		);
		
		
		$query = " 
			INSERT INTO stories.`".$t."_option`(
				pageID,
				author,
				text,
				command, 
				VisibleWithFlag,
				HiddenWithFlag,
				giveToken,
				removeToken,
				targetPage
			) VALUES (
				:PageID,
				:Author,:text,:command,:visibleWithFlag,:HiddenWithFlag,:giveToken,:removeToken,:targetPage
				);
				UPDATE stories SET edits = edits + 1 WHERE title='".$t."';
				UPDATE stories SET Pages = Pages + 1 WHERE title='".$t."';				
			   ";
	   
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
			die("2a)Failed to run query: " . $ex->getMessage()); 
		}
		
		
		
		//if going to a specific page, skip adding the option text.
		if($targetPage!=null){
			
			//This adds the option text as the first post into the new page on the story table
			$query_params = array(
			':PageID' => $targetPage,
			':subID' => '0',
			':Author' => $_SESSION['user']['username'],
			':text' => $text,
			':command' => null,
			':visibleWithFlag' => null,
			':HiddenWithFlag' => null
			
			);
			
			
			$query = " 
				INSERT INTO stories.`".$t."_story`(
					pageID,
					subID,
					author,
					text,
					command, 
					VisibleWithFlag,
					HiddenWithFlag				
				) VALUES ( 
					:PageID,
					:subID,:Author,:text,:command,:visibleWithFlag,:HiddenWithFlag
				);
				
				   ";
		   
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
				die("3a)Failed to run query: " . $ex->getMessage()); 
			}
		}
	 header('Location: Read.php?Story='.$title.'&Page='.$targetPage.' ' );     
	 //post doesn't have tokens0..
    }
  

	//header('Location: 404.php?Message="what are yo9u even trying mate?" ');     
    ?>
    </body>

  </html>