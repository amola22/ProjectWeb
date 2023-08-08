<?php
require_once __DIR__ . '/../database_connection/database_connection.php';
//authenticate login for patient
function database_receptionist_authenticate($email,$password){
    $conn=database_connect();
    $stmt=mysqli_prepare($conn,'
        select * from receptionist where email = ?
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
//select patient that are available today
function database_select_available_patients_today() {
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'SELECT p.name as pname, p.email, p.phone, s.service, s.price, p.time, d.name
        FROM patient p
        JOIN services s ON p.service_id = s.id 
        JOIN doctors d ON p.doctor_id = d.id
        WHERE p.date = CURDATE()');
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $patients = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $patients;
}

