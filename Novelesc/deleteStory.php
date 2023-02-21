<!DOCTYPE html>
<html>
<!--head-->
  <head>

  </head>
  <body>
  
<?php 

    // First we execute our common code to connection to the database and start the session
    require("common.php");
	
	//if(!empty($_POST))
    //{
    	$Page=$_GET['Page'];
		$title=$title=htmlentities($_GET['Story'], ENT_QUOTES, 'UTF-8');	
   	  	$t=str_replace ( "\'" , "\"" , $title );
		$subID=$_GET['subID'];
	
	
	//i will still need to be able to delete the option.
	
	
	//find the delete the right paragraph.
	$query_params = array(
			':PageID' => $Page,
			':subID' => $subID,
			':Author' => $_SESSION['user']['username']
			);
			
			$query = " 
				UPDATE stories SET edits = edits + 1 WHERE title='".$t."';
				DELETE FROM stories.`".$t."_story`
				WHERE pageID=:PageID 
					AND	subID=:subID 
					AND author=:Author;
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
				die("delete)Failed to run query: " . $ex->getMessage());
			}
		
	/*}
	else{
		echo "post not set";
	}
	*/
	 header('Location: Read.php?Story='.$_GET['Story'].'&Page='.$_GET['Page']);
	
		//DELETE FROM :table_name WHERE pageID=:page and subID=:subID;	
?>