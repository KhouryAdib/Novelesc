<!DOCTYPE html>
<html>

<?php 

require("header.php");
require("common.php"); 

if(!empty($_SESSION['user'])){


$Page=$_GET['Page'];
$title=htmlentities($_GET['Story'], ENT_QUOTES, 'UTF-8');


$query_params = array(
		':PageID' => $Page,
		':Title' => $title,
		':username' => $_SESSION['user']['username'],
		':focused' => 0
		);
		
		//If there isn't a bookmark for the current page, create one.
		//should be, if there isn't a bookmark with the same history create one.
		$query = "IF NOT exists(Select * FROM bookmarks where page = :PageID and title = :Title	and username=:username)
				then INSERT INTO bookmarks(page,title,username,focused,bookmark) VALUES (:PageID,:Title,:username,:focused
				, (Select bookmark from bookmarks where username=:username and title=:Title and focused=1)
				);
				
				end if
			   ";
	   //(Select 1 from bookmarks where username=:username and title=:Title and focused!=:focused)
		try 
		{
			
			$stmt = $db->prepare($query); 
			$result = $stmt->execute($query_params);
		}
		catch(PDOException $ex)
		{
			// It may provide an attacker with helpful information about your code.  
			die("bookmarks)Failed to run query: " . $ex->getMessage()); 
		}
}
header('Location: Read.php?Story='.$title.'&Page='.$Page.' ' );
?>



</html>