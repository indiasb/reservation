<?php

session_start();
include("inc/constant.php");

$name = isset($_POST['name']) ? $_POST['name'] :""; 
$email = isset($_POST['email']) ? $_POST['email'] :""; 
$phone = isset($_POST['phone']) ? $_POST['phone'] :"";
$date = isset($_POST['date']) ? $_POST['date'] :"";
$time = isset($_POST['time']) ? $_POST['time'] :"";
$errors = [];

if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors["email"] = "L'email n'est pas valide";
    var_dump($errors["email"]);
}

$name =htmlspecialchars($name);
$email=htmlspecialchars($email);
$phone=htmlspecialchars($phone);
$date =htmlspecialchars($date);
$time =htmlspecialchars($time);

if(count($errors) > 0) { 
    $_SESSION["compte-données"]["name"] = $name; 
    $_SESSION["compte-données"]["email"] = $email; 
    $_SESSION["compte-données"]["phone"] = $phone;
    $_SESSION["compte-données"]["date"] = $date;
    $_SESSION["compte-données"]["time"] = $time;
    $_SESSION["compte-errors"] = $errors;
    foreach ($errors as $error) {
        echo"<h2>$error</h2>";
    };
    
    exit();
}

foreach($_POST as $key => $val) { 
    $params[":" . $key] = (isset($_POST[$key]) && !empty($_POST[$key])) ? htmlspecialchars($_POST[$key]) : null;
}

try {

    $cnn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
  
    $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $cnn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $sql = 'SELECT COUNT(*) as nb FROM reservations WHERE email=?';
    $qry = $cnn->prepare($sql);
    $qry->execute(array($params[':email']));
    $row = $qry->fetch();
    
    if($row['nb'] ==1){
        echo"<h2> Cet email existe deja !";

    }else{
        $sql='INSERT INTO reservations(name, email, phone, date, time)VALUES(:name, :email, :phone, :date, :time)';
        $qry=$cnn->prepare($sql);
        $qry->execute($params);
        unset($cnn);

        header("location: tableau_reservation.php");
    }

} catch(PDOException $err){

    $err->getMessage();
    $_SESSION["compte-errors-sql"] = $err->getMessage();
    $_SESSION["compte-données"]["name"] = $name;  
    $_SESSION["compte-données"]["email"] = $email; 
    $_SESSION["compte-données"]["phone"] = $phone; 
    $_SESSION["compte-données"]["date"] = $date; 
    $_SESSION["compte-données"]["time"] = $time; 
    var_dump($err);
 
exit;
}

?>