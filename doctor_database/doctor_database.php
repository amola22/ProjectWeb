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
function database_doctor_authenticate($email,$password){
    $conn=database_connect();
    $stmt=mysqli_prepare($conn,'
        select * from doctors where email = ?
        and password = ?
    ');
    mysqli_stmt_bind_param($stmt,'ss',$email,$password);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result)>0){
        $user=(object)mysqli_fetch_assoc($result);
    }else{
        $user=null;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $user;
} 
//add data in doctor
function database_add_doctors($name,$phone,$email,$password){
    $conn =database_connect();
    $stmt=mysqli_prepare($conn,'insert into doctors(name,phone,email,password)
    values(?,?,?,?)');
    mysqli_stmt_bind_param($stmt,'ssss',$name,$phone,$email,$password);
    mysqli_stmt_execute($stmt);
    //$result=mysqli_query($conn,'select * from patients where MRN = '.$mrn);
    //$patient=mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
//check doctor  email exist
function database_doctor_check_email_exist($email){
    $conn=database_connect();
    $stmt=mysqli_prepare($conn,'
        select email from doctors where email = ?
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
//update date and time in database from screen appoientement
function database_add_doctors_date_time($date_from,$date_to,$time_from,$time_to,$id){
    $conn =database_connect();

    $stmt = mysqli_prepare($conn,'update doctors set date_from=?, date_to=?,time_from=?,time_to=? where id = ?');
    // bind the parameters
    mysqli_stmt_bind_param($stmt,'ssssi',$date_from,$date_to,$time_from,$time_to,$id);
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
/*
 $conn =database_connect();
    $result=mysqli_query($conn,'update doctors set date_from='.$date_from.', date_to='.$date_to.',time_from='.$time_from.',time_to='.$time_to.' where id = '.$id);
    $patient=mysqli_fetch_assoc($result);
    mysqli_close($conn);*/ 

    // return patients to doctor to write prescription
    function database_select_patients_to_write_prescription($id) {
        $conn = database_connect();
        $stmt = mysqli_prepare($conn, 'SELECT p.name, p.email, p.phone,p.MRN, s.service 
        FROM patient p 
        JOIN services s ON p.service_id = s.id 
        WHERE p.doctor_id = ?
        ');
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $patients = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $patients;
    }
    
    
    /*function database_select_patients_to_write_prescription($id){
        $conn=database_connect();
        $stmt=mysqli_prepare($conn,'
            select * from patient where doctor_id = ?
        ');
        mysqli_stmt_bind_param($stmt,'i',$id);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result)>0){
            $user=(object)mysqli_fetch_assoc($result);
        }else{
            $user=null;
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $user;

    }*/
    //select information about doctors
    function database_get_doctor($id){
        $conn = database_connect();
        $stmt = mysqli_prepare($conn,'select * from doctors where id = ?');
        mysqli_stmt_bind_param($stmt,'i',$id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result)){
            $doctor=(object)mysqli_fetch_assoc($result);
        }else{
            $doctor=null;
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $doctor;
    }
    
  //update_doctor_profile_image
  function database_update_doctor_profile_image($id,$image_name){
    $conn=database_connect();  $stmt = mysqli_prepare($conn,'update doctors set profile_image=? where id = ?');
    // bind the parameters
    mysqli_stmt_bind_param($stmt,'si',$image_name,$id);
    // execute the statement
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

  }