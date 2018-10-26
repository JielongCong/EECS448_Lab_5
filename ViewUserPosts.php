<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "j632c688", "bae9waiC", "j632c688");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$user_id = $_POST["userName"];
$exist = false;



$query = "SELECT author_id, post_id, content from Posts";

if($result = $mysqli->query($query))
{
	if($result->num_rows > 0)
	{
		echo "<table border=\"1\">";
		echo "<tr>";
		echo "<th>post_id</th>";
		echo "<th>author_id</th>";
		echo "<th>content</th>";
		echo "<tr>";
		while($row = $result->fetch_assoc())
		{
			if($row["author_id"] == $user_id)
			{
				echo "<tr>";
				echo "<td>" . $row["post_id"] . "</td>";
				echo "<td>" . $row["author_id"] . "</td>";
				echo "<td>" . $row["content"] . "</td>";
				echo "</tr>";
				$exist = true;
			}
		}

		echo "</table>";
	}
}

if($exist == false)
{
	echo "We don't find this user.";
}

$exist = false;

/* close connection */
$mysqli->close();
?>


