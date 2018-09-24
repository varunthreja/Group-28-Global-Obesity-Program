<!DOCTYPE html>
<html>
<head>
	<script>
		function showAlert(modelURL){
			alert(modelURL);
		}
	</script>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "catalogue";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT imgURL, NAME, modelURL FROM models";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
					echo "<td><button></button></td>";
					echo "<a onclick='alert('".$row[$modelURL]."')'><img width=120 height=120 src='" . $row["imgURL"].")'/></a>"."<br>" ;
					echo $row['NAME']."<br>";
					//echo $row['modelURL'] ;
                }
            } else {
                echo "<h1>Page Not Found!</h1>";
            }
?>
</body>
</html>