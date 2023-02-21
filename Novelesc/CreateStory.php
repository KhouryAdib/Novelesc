<!DOCTYPE html>
<html>
<!--head-->
  <head>

  </head>
  <body>
<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // This if statement checks to determine whether the registration form has been submitted 
    // If it has, then the registration code is run, otherwise the form is displayed 
    if(!empty($_POST))
    {
        // Ensure that the user has entered a non-empty username 
        if(empty($_POST['Title'])) 
        { 
            // Note that die() is generally a terrible way of handling user errors 
            // like this.  It is much better to display the error with the form 
            // and allow the user to correct their mistake.  However, that is an 
            // exercise for you to implement yourself. 
            die("Please enter a Title.");
        }
		
        // Ensure that the user has entered a non-empty password 
        if(empty($_POST['Story'])) 
        { 
            die("Please enter the story."); 
        }

        if(empty($_POST['desc'])) 
        { 
            die("Please enter the description."); 
        }
		
		if(strlen($_POST['Title'])>255){
			die("Please shorten the title"); 
		}
     
		if(strlen($_POST['Story'])>3000){
			die("Please shorten the story text");
		}
		
		if(strlen($_POST['desc'])>255){
			die("Please shorten the description");
		}
        
        $t=ucfirst (trim(str_replace ( "'" , "" , $_POST['Title']))); 
        // We will use this SQL query to see whether the username entered by the 
        // user is already in use.  A SELECT query is used to retrieve data from the database. 
        // :username is a special token, we will substitute a real value in its place when 
        // we execute the query. 
        $query = "
            SELECT 
                1 
            FROM stories 
            WHERE title = ':Title' 
        ";
         
        // This contains the definitions for any special tokens that we place in 
        // our SQL query.  In this case, we are defining a value for the token 
        // :username.  It is possible to insert $_POST['username'] directly into 
        // your $query string; however doing so is very insecure and opens your 
        // code up to SQL injection exploits.  Using tokens prevents this. 
        // For more information on SQL injections, see Wikipedia: 
        // http://en.wikipedia.org/wiki/SQL_Injection 
        $query_params = array( 
            ':Title' => $t
        );
         
        try 
        { 
            $result = $db->query($query);
            $row = $result->fetch();

        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("1)Failed to run query: " . $ex->getMessage()); 
        }
         
        // The fetch() method returns an array representing the "next" row from 
        // the selected results, or false if there are no more rows to fetch. 
        $stmt = $db->prepare($query); 
        $row = $stmt->fetch(); 
         
        // If a row was returned, then we know a matching username was found in 
        // the database already and we should not allow the user to continue. 
        if($row) 
        { 
            die("This title is already in use");
        } 
                  
        // An INSERT query is used to add new rows to a database table. 
        // Again, we are using special tokens (technically called parameters) to 
        // protect against SQL injection attacks.
        $query = " 
            INSERT INTO stories ( 
                stories.title,
                stories.author,
                stories.Descrip
            ) VALUES ( 
                :Title,
                :Author,
                :Description
            )";    
        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store 
        // the salt (in its plaintext form; this is not a security risk). 
        $query_params = array( 
            ':Title' => $t,
            ':Description' => $_POST['desc'],
            ':Author' => $_SESSION['user']['username']            
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
            die("2)Failed to run query: " . $ex->getMessage()); 
        }
         
        // This redirects the user back to the login page after they register 
        //header("Location: login.php"); 
         
        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        //die("Redirecting to login.php"); 

		//trying to create a table.

		

		//instead of stories, maybe genre? or something
		//might need to change the options to handle more than one option. like both add and remove flags kinda thing
		
		$query = " 
            CREATE TABLE stories.`".$t."_story` (pageID INT NOT NULL,subID INT NOT NULL ,author CHAR(30),Text TEXT(12000),VisibleWithFlag CHAR(30),HiddenWithFlag CHAR(30),Command BOOLEAN,picture Boolean);
            CREATE TABLE stories.`".$t."_option` (optionID INT NOT NULL AUTO_INCREMENT UNIQUE, pageID INT NOT NULL ,author CHAR(30),Text TEXT(12000),Command BOOLEAN,giveToken CHAR(30),removeToken Char(30),VisibleWithFlag CHAR(30),HiddenWithFlag CHAR(30), targetPage INT NOT NULL,PRIMARY KEY (optionID));
        ";
                  
         
        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store 
        // the salt (in its plaintext form; this is not a security risk). 


        $query_params = array();
         
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
            die("3)Failed to run query: " . $ex->getMessage()); 
        }

        $query = " 
            INSERT INTO stories.`".$t."_story` ( 
                pageID,
                author, 
                text, 
                command,
				VisibleWithFlag,
				HiddenWithFlag
            ) VALUES ( 
            	0,
                :Author, 
                :text, 
                :command,
				:VisibleWithFlag,
				:HiddenWithFlag
            ) 
               ";
                  
         
        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store 
        // the salt (in its plaintext form; this is not a security risk). 


        $query_params = array(
        ':Author' => $_SESSION['user']['username'],
        ':text' => $_POST['Story'],
        ':command' => "0",
		':VisibleWithFlag' => null,
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
            die("4)Failed to run query: " . $ex->getMessage()); 
        }
        header('Location: Read.php?Story='.$t);
    }else{
        header('Location: Create.php');
    } 
     
?> 

  </body>
</html>