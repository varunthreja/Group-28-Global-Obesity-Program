<?php
include "config.php";
include "password.php";
$mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_TABLENAME);
$query = $_REQUEST['query'];

/* check connection */
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

if ($result = mysqli_query($mysqli, $query)) {
  $out = array();

  while ($row = $result->fetch_assoc()) {
    $out[] = $row;
  }

  /* encode array as json and output it for the ajax script*/
  echo json_encode($out);


  /* free result set */
  mysqli_free_result($result);

}



/* close connection*/
$mysqli->close();
?>