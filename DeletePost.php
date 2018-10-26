<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "j632c688", "bae9waiC", "j632c688");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

echo "<h1>The post you just delete.</h1>";

echo "<table border=\"1\">";
echo "<tr>";
echo "<th>post_id</th>";
echo "<th>author_id</th>";
echo "<th>content</th>";
echo "<th>status</th>";
echo "<tr>";


if(!empty($_POST["delete"]))
{
	foreach($_POST["delete"] as $selected)
	{
		$query = "SELECT author_id, post_id, content from Posts";

		if($result = $mysqli->query($query))
		{
			if($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
				{
					if($row["post_id"] == $selected)
					{
						echo "<tr>";
						echo "<td>" . $row["post_id"] . "</td>";
						echo "<td>" . $row["author_id"] . "</td>";
						echo "<td>" . $row["content"] . "</td>";
						
						$temp = $row["author_id"];
						echo $temp;
					
						$query = "DELETE FROM Posts WHERE post_id='$selected'";
						if($result = $mysqli->query($query))
						{
							$query = "DELETE FROM Users WHERE user_id='$temp'";
							if($result = $mysqli->query($query))
							{
								echo "<td>delete</td>";	
							}
							else
							{
								echo "<td>error when delete in Users.</td>";
							}
						}
						else
						{
							echo "<td>error when delete in Posts.</td>";
						}

						echo "</tr>";
						break;
					}
				}

			}
		}
	}
}
else
{
	echo "You didn't select any post.";
}

echo "</table>";


/* close connection */
$mysqli->close();
?>


