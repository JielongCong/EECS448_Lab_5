<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "j632c688", "bae9waiC", "j632c688");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$userName = $_POST["userName"];
$post = $_POST["post"];
$exist = false;

$query = "SELECT author_id from Posts";
$result = $mysqli->query($query);

if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		if($row["author_id"] == $userName)
		{
			$exist = true;
			break;
		}
	}		
}
else
{
	echo "0 results <br>";
}

if($exist)
{
	$query = "Update Posts 
		set content = '$post' 
		where author_id = '$userName'";

	if ($mysqli->query($query)) 
	{
		echo "New record created successfully<br>";
		echo "Your author id is: " . $userName . "<br>";
		echo "Your post content is: " . $post . "<br>";
	}
	else
	{
		echo "Error.<br>";	
	}	
}
else
{
	echo "We didn't find the user.<br>";
}


/* close connection */
$mysqli->close();
?>


