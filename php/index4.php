<?php
//setting header to json
header('content-type: application/json');

//database
$DB_HOST = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'din';


//get connection
$mysqli = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = "SELECT sensors_data_date,sensors_temperature_data FROM tbl_sensors_data ORDER BY sensors_data_date ASC, sensors_data_time ASC";

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$jsonArray = array();
  while($row = $result->fetch_array()) {
      $data = array();

		    $data['date'] = $row['sensors_data_date'];
		    $data['value'] = (int)$row['sensors_temperature_data'];
		    //append the above created object into the main array.
		    array_push($jsonArray, $data);
		  }

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($jsonArray);
?>