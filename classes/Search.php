
<?php

$search_value = $_POST["search"];
require_once "./connection.php";
$query = "SELECT * FROM tbl_event WHERE eventName LIKE '%{$search_value}%'";
$result = mysqli_query($link, $query) or die("SQL Query Failed.");
$show = "";
if(mysqli_num_rows($result) > 0 ){
  $show = '<table class="tblone"><tr>
  <th>Event Name</th>
  <th>Description</th>
  <th>Address</th>
  <th>Location</th>
  <th>Date</th>
  <th>Time</th>
  </tr>';

  while($row = mysqli_fetch_assoc($result)){
    $show .= "<tr>
        <td>" . $row['eventName'] . "</td>
        <td>" . $row['body'] . "</td>
        <td>" . $row['address'] . "</td>
        <td>" . $row['location'] . "</td>
        <td>" . $row['date'] . "</td>
        <td>" . $row['time'] . "</td>
    </tr>";
}
    $show .= "</table>";
    echo $show;
}else{
    echo "<h2>No Record Found.</h2>";
}
?>