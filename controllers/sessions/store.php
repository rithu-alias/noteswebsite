<?php
use Core\Database;
use Core\Validator;
require base_path('Core/Validator.php');

$email = $_POST['email'];
$password = $_POST['password'];
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
    dd('hello');
    return view('sessions/create.view.php');
}

$user = $db->query('select * from users where email = :email',[
    'email' => $email
])->find();

if(!$user){
    
    return view('sessions/create.view.php');
}

if(password_verify($password,$user['password'])){
    login([
        'email'=>$email
    ]);
    header('location: /home');
    exit();
}

return view('sessions/create.view.php');



