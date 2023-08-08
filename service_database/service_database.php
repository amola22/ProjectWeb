<?php
/*//database connection parameters
define('HOSTNAME','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DATABASE','test2');

//connect to database and return connection object

function database_connect(){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);
    return $conn;
}*/
require_once __DIR__ . '/../database_connection/database_connection.php';


//read  all patients data from database

function database_get_all_services(){
    $conn =database_connect();
    $result=mysqli_query($conn,'select * from services');
    $service=mysqli_fetch_all($result,MYSQLI_ASSOC);
    //$patient=mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $service;
}
//set service_id equal id to be can read it 
function database_set_service_id_equal_id($id,$MRN){
    $conn =database_connect();
$stmt = $conn->prepare("UPDATE patient SET service_id=? WHERE MRN=?");
$stmt->bind_param("ii", $id,$MRN);
// Execute statement
if ($stmt->execute() === TRUE) {
    echo "Record updated successfully";
   // header('location:succ_app.php');

} else {
    echo "Error updating record: " . $conn->error;
}
// Close connection
$conn->close();
}
