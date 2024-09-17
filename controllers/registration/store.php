<?php

use Core\Validator;
use Core\Database;
require base_path('Core/Validator.php');

$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$photo = $_POST['photo'];


$config = require base_path('config.php');
$db = new Database($config['database']);
$errors = [];
if(!Validator::email($email)){
    $errors['email'] = 'please provide a valid email address';
}

if(!Validator::string($password,7,255)){
    $errors['password'] = 'please provide a valid password atlest 7 charecters';
}
if(!empty($errors)){
    return view('registration/create.view.php');
}
$user = $db->query('select * from users where email = :email',[
    'email' => $email
])->find();

if($user){
    header('location: /contact');
    exit();
}
else{
    $db->query('insert into users(email,password,username,first_name,last_name,photo) values(:email,:password,:username,:first_name,:last_name,:photo)',[
        'email'=>$email,
        'password'=>password_hash($password,PASSWORD_BCRYPT),
        'username'=>$username,
        'first_name'=>$first_name,
        'last_name'=>$last_name,
        'photo'=>$photo,
    ]);
    $_SESSION['user'] =[
        'email'=>$email,
        'username'=>$username,
        'first_name'=>$first_name,
        'last_name'=>$last_name,
        'photo'=>$photo
    ];
    header('location: /home');
    exit();
}