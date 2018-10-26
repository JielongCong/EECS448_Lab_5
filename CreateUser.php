<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "j632c688", "bae9waiC", "j632c688");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$user_id = $_POST["userID"];
$exist = false;


$query = "SELECT user_id from Users";
$result = $mysqli->query($query);

if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		if($row["user_id"] == $user_id)
		{
			$exist = true;
			break;
		}
	}		
}

if($exist)
{
	echo "The user already exists.<br>";
}
else
{
	$query = "INSERT INTO Users (user_id) VALUES ($user_id)";
	if ($mysqli->query($query)) 
	{
		echo "New record created successfully<br>";
		$query = "SELECT user_id from Users";
		$result = $mysqli->query($query);

		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				echo "user_id: " . $row["user_id"] . "<br>";
			}		
		}
		else
		{
			echo "0 results.<br>";
		}
	}
	else
	{
		echo "Error.<br>";	
	}

	$query = "INSERT INTO Posts (author_id) VALUES ($user_id)";
	if ($mysqli->query($query)) 
	{
		$query = "SELECT author_id from Posts";
		$result = $mysqli->query($query);

		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				echo "author_id: " . $row["author_id"] . "<br>";
			}		
		}
		else
		{
			echo "0 results<br>";
		}
	}
	else
	{
		echo "Error.<br>";	
	}
}
	
$exist = false;	

/* close connection */
$mysqli->close();
?>


