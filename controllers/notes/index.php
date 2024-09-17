<?php 
    use Core\Database;
    $config = require base_path('config.php');
    $db = new Database($config['database']);
    $email = $_SESSION['user']['email'];
    $notes = $db->query('select * from notes where email = :email',[
        'email'=>$email
    ])->get();
    

    $heading = "My Notes";
    require view("notes/index.view.php");
?>
