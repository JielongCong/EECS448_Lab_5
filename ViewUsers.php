<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "j632c688", "bae9waiC", "j632c688");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT user_id from Users";
$result = $mysqli->query($query);

echo "<table border=\"1\">";
echo "<th>user_id</th>";

if($result->num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		echo "<tr>";
		echo "<td>" . ($row["user_id"]) . "</td>";
		echo "</tr>";
	}	

	echo "</table>";	
}
else
{	
	echo "No users.";	
}

/* close connection */
$mysqli->close();
?>


