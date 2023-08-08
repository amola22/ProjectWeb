<?php
//database connection parameters
/*define('HOSTNAME','localhost');
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



// insert prescription_content in prescription database
function database_insert_prescription($content){
    $conn =database_connect();
    $stmt=mysqli_prepare($conn,'insert into prescription(content)
    values(?)');
    mysqli_stmt_bind_param($stmt,'s',$content);
    mysqli_stmt_execute($stmt);
    $inserted_id = mysqli_insert_id($conn); 
    //$result=mysqli_query($conn,'select * from patients where MRN = '.$mrn);
    //$patient=mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $inserted_id; // Return the inserted ID

}
//update doctor_id and patient_id
function database_update_prescription(  $doctor_id, $MRN,$prescription_id) {
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'UPDATE prescription SET  doctor_id=?, patient_MRN=? WHERE id=?');
    mysqli_stmt_bind_param($stmt, 'iii', $doctor_id, $MRN, $prescription_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
//functon to patient one patient by id
function database_get_one_patient_to_update_prescription_MRN($MRN){
    
    $conn =database_connect();
    $stmt=mysqli_prepare($conn,'select * from patient where MRN = ?');
    mysqli_stmt_bind_param($stmt,'i',$MRN);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    //$result=mysqli_query($conn,'select * from patients where MRN = '.$mrn);
    $patient=mysqli_fetch_assoc($result);
    //$patient=mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $patient;

}
function database_get_one_patient_to_write_prescription($MRN){
    
    $conn =database_connect();
    $stmt=mysqli_prepare($conn,'select * from patient where MRN = ?');
    mysqli_stmt_bind_param($stmt,'i',$MRN);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    //$result=mysqli_query($conn,'select * from patients where MRN = '.$mrn);
    $patient=mysqli_fetch_assoc($result);
    //$patient=mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $patient;

}

//select prescription info to present it to patient
function database_select_prescription_info_to_patient($MRN){
    $conn = database_connect();
   /* $stmt = mysqli_prepare($conn,'
    select d.name,s.service,s.price 
    from patient p ,doctor d,services s 
    where doctor_id=id and service_id=id and MRN=?
    ');*/
    $stmt = mysqli_prepare($conn,'
    SELECT d.name,d.id, s.service, s.price 
    FROM patient p 
    JOIN doctors d ON p.doctor_id = d.id 
    JOIN services s ON p.service_id = s.id 
    WHERE p.MRN = ?
');
    mysqli_stmt_bind_param($stmt, 'i', $MRN);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $prescriptions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $prescriptions;
}
//select prescription to show it to the user
function database_select_prescription_content_to_patient($MRN,$id){
    $conn = database_connect();
    /* $stmt = mysqli_prepare($conn,'
    select d.name,s.service,s.price 
    from patient p ,doctor d,services s 
    where doctor_id=id and service_id=id and MRN=?
    ');*/
    $stmt = mysqli_prepare($conn,'
    SELECT * 
    FROM prescription 
    WHERE patient_MRN = ? and doctor_id=?
');
    mysqli_stmt_bind_param($stmt, 'ii', $MRN,$id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $prescriptions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $prescriptions;
}
