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
		$user=$_SESSION['user']['username'];
		$ID=$_GET['id'];
	
	
	//i will still need to be able to delete the option.
	
	
	//find the delete the right paragraph.
	$query_params = array(
			':id' => $ID,
			':username' => $_SESSION['user']['username']
			);
			
			$query = " 
				DELETE FROM bookmarks
				WHERE id=:id
					AND	username=:username 
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
	 header('Location: bookmarks.php');
	
		//DELETE FROM :table_name WHERE pageID=:page and subID=:subID;	
?>