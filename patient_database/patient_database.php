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


//authenticate login for patient
function database_patient_authenticate($email,$password){
    $conn=database_connect();
    $stmt=mysqli_prepare($conn,'
        select * from patient where email = ?
        and password = ?
    ');
    mysqli_stmt_bind_param($stmt,'ss',$email,$password);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result)>0){
        $user=(object)mysqli_fetch_assoc($result);
    }else{
        $user=null;
    }    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $user;
}
//insert data  in patient 
function database_add_patient($name,$phone,$email,$password){
    $conn =database_connect();
    $stmt=mysqli_prepare($conn,'insert into patient(name,phone,email,password)
    values(?,?,?,?)');
    mysqli_stmt_bind_param($stmt,'ssss',$name,$phone,$email,$password);
    mysqli_stmt_execute($stmt);
    //$result=mysqli_query($conn,'select * from patients where MRN = '.$mrn);
    //$patient=mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
//check patient  email exist
function database_patient_check_email_exist($email){
    $conn=database_connect();
    $stmt=mysqli_prepare($conn,'
        select email from patient where email = ?
    ');
    mysqli_stmt_bind_param($stmt,'s',$email);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $user=mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    if(mysqli_num_rows($result)){
        return true;
    }
    return false;
}
/*
//update date and time in database from screen appoientement
function database_add_patient_date_time($date,$time,$id){
    $conn =database_connect();
    $stmt = mysqli_prepare($conn,'update patient set date=?,time=? where id = ?');
    // bind the parameters
    mysqli_stmt_bind_param($stmt,'ssi',$date,$time,$id);
    // execute the statement
    mysqli_stmt_execute($stmt);
    // check the result
    if (mysqli_stmt_affected_rows($stmt) > 0) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . mysqli_stmt_error($stmt);
    }
    // close the statement
    mysqli_stmt_close($stmt);
}*/
/*
function database_search_patient_by_date_time($date,$time){
    $conn =database_connect();
    $stmt=mysqli_prepare($conn,'select * from doctor d,patient p  where p.date  between d.date_from and d.date_to and p.time d.time_from and d.time_to)');
    //$stmt=mysqli_prepare($conn,'select * from doctors where date_from<=? and date_to>=? and time_from<=? and time_to>=?');

    mysqli_stmt_bind_param($stmt,'ssss',$date,$date,$time,$time);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    //$result=mysqli_query($conn,'select * from patients where MRN = '.$mrn);
    $patients=mysqli_fetch_all($result,MYSQLI_ASSOC);
    //$patient=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        $patient=(object)mysqli_fetch_assoc($result);
    }else{
        $patient=null;
    }    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $patient;
}
//search for doctors by date and time 
function database_search_patient_by_date_time(){
    $conn =database_connect();
    $result=mysqli_query($conn,'select * from doctors d,patient p  where p.date  between d.date_from and d.date_to and p.time d.time_from and d.time_to)');
    $patient=mysqli_fetch_all($result,MYSQLI_ASSOC);
    //$patient=mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $patient;
}
function database_search_patient_by_date_time() {
    $conn = database_connect();
    $result = mysqli_query($conn, 'SELECT * FROM doctors d, patient p WHERE p.date BETWEEN d.date_from AND d.date_to AND p.time BETWEEN d.time_from AND d.time_to');
    $patients = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $patients;
}
function database_search_patient_by_date_time() {
    $conn = database_connect();
    $result = mysqli_query($conn, "SELECT d.*, p.* FROM doctors d, patient p WHERE p.date BETWEEN d.date_from AND d.date_to AND p.time BETWEEN d.time_from AND d.time_to");
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $data;
}*/
function database_search_doctor_by_date_time($date,$time) {
    $conn = database_connect();
    $result = mysqli_query($conn, "SELECT * FROM doctors WHERE date_from <= '$date' AND date_to >= '$date' AND time_from <= '$time' AND time_to >= '$time'");
    $doctors = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $doctors;
}



//read  all patients data from database

function database_get_all_patients(){
    $conn =database_connect();
    $result=mysqli_query($conn,'select * from doctors');
    $patient=mysqli_fetch_all($result,MYSQLI_ASSOC);
    //$patient=mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $patient;
}
//update date and time in database from screen appoientement
function database_add_patient_date_time($date,$time,$id){
    $conn =database_connect();

    $stmt = mysqli_prepare($conn,'update patient set date=?,time=? where MRN = ?');
    // bind the parameters
    mysqli_stmt_bind_param($stmt,'ssi',$date,$time,$id);
    // execute the statement
    mysqli_stmt_execute($stmt);
    // check the result
    if (mysqli_stmt_affected_rows($stmt) > 0) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . mysqli_stmt_error($stmt);
    }
    // close the statement
    mysqli_stmt_close($stmt);
}
/*//get patient info from the database
function database_get_all_patients_info_to_prescription($MRN) {
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'SELECT * FROM patient WHERE MRN = ?');
    mysqli_stmt_bind_param($stmt, 'i', $MRN);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $patient = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $patient;
}
*/
//update patient doctor _id and service_id null 
function database_update_patient_doctor_id_service_id_to_null($id) {
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'UPDATE patient SET doctor_id = NULL, service_id = NULL WHERE MRN = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
 //select information about doctors
 function database_get_patient($id){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn,'select * from patient  where MRN = ?');
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result)){
        $patient=(object)mysqli_fetch_assoc($result);
    }else{
        $patient=null;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $patient;
}

//update_doctor_profile_image
function database_update_patient_profile_image($id,$image_name){
$conn=database_connect(); 
 $stmt = mysqli_prepare($conn,'update patient set profile_image=? where MRN = ?');
// bind the parameters
mysqli_stmt_bind_param($stmt,'si',$image_name,$id);
// execute the statement

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

}


