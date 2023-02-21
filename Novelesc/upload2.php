<?php
require("common.php");
$date = date(mktime(0, 0, 0, 7, 1, 2000));
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$title =trim(str_replace ( "'" , "" , $_POST['Story']));
$Page = $_POST['Page'];
$fileName =$date.rand().".".$extension;
$tmpName  = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileType = $_FILES['file']['type'];
if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}


if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  } else {
  	$query = " 
            INSERT INTO stories.`".$title."_story`(
                pageID,
                author,
                text,
                command, 
                VisibleWithFlag,
				HiddenWithFlag,
				picture
            ) VALUES ( 
            	:PageID,
                :Author,
                :text,
                :command,
				:flag,
				:HiddenWithFlag,
				:picture
            );UPDATE stories SET edits = edits + 1 WHERE title='".$title."'
			
               ";       
         
        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store 
        // the salt (in its plaintext form; this is not a security risk). 
        $query_params = array(
        ':PageID' => $Page,
        ':Author' => $_SESSION['user']['username'],
        ':text' => $fileName,
        ':command' => "0",
        ':flag' => $_FILES['file']['name'],
		':HiddenWithFlag' => null,
		':picture' => "1"
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
            die("upload 3)Failed to run query: " . $ex->getMessage()); 
        }



    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
    if (file_exists("upload/" . $fileName)) {
      echo $_FILES["file"]["name"] . " already exists. ";
    } else {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $fileName);
     // echo "Stored in: " . "/upload/" . $_FILES["file"]["name"];
	 $Page=$_GET['Page'];
	 $title=$_GET['Story'];	
	  header('Location: Read.php?Story='.$title.'&Page='.$Page);
    }
  }
} else {
  echo "Invalid file";
}
?>