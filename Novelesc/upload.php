<?php
require("common.php"); 
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];
$title =trim(str_replace ( "'" , "" , $_POST['Story']));
$Page = $_POST['Page'];
print($title."<br>");

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);

if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}

$query = "INSERT INTO upload (name, size, type, content) ".
"VALUES (:fileName, :fileSize, :fileType, :content)";

        $query_params = array( 
            ':fileName' => $fileName,
            ':fileSize' => $fileSize,
            ':fileType' => $fileType,
            ':content' => $content     
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
            die("upload)Failed to run query: " . $ex->getMessage()); 
        }
 				$query = " 
		            SELECT
		            *
		            FROM capstone.upload 
		            WHERE name='".$fileName."'
		            AND size='".$fileSize."'
		         ";

		        try 
		        {
		            // These two statements run the query against your database table.

		            $result = $db->query($query);
		            $row = $result->fetchALL();
		            $id=$row['0']['id'];
		         	$var=$row['0']['content'];
		         	header("Content-type: image/jpeg");
		         	header('Content-Disposition: filename="butterfly.jpg"');
		         	imagejpeg($var, null, 95); 
					exit;



		         	#echo '<dt><strong>Technician Image:</strong></dt><dd>'
				    # . '<img src="data:image/jpeg;base64,' . base64_encode($row[0]['content']) . '" width="290" height="290">'
				    # . '</dd>';
					
		        	



				}
		        catch(PDOException $ex) 
		        {
		            // Note: On a production website, you should not output $ex->getMessage(). 
		            // It may provide an attacker with helpful information about your code.
		            echo mysql_error();   
		            die("upload 2)Failed to run query: ".$ex->getMessage()); 
		        }


 			$query = " 
            INSERT INTO stories.`".$title."_story`(
                pageID,
                author,
                command, 
                flag 
            ) VALUES ( 
            	:PageID,
                :Author,:command,:flag
            );
			
               ";
                  
         
        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store 
        // the salt (in its plaintext form; this is not a security risk). 
        $query_params = array(
        ':PageID' => $Page,
        ':Author' => $_SESSION['user']['username'],
        ':command' => "1",
        ':flag' => $id
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


    


echo "<br>File $fileName uploaded<br>";

}else{
	print("it didn't upload");
}
?>