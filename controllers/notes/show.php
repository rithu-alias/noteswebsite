<?php 
    use Core\Database;
    $config = require base_path('config.php');
    $db = new Database($config['database']);
    $emailuser = $_SESSION['user']['email'];
  
    $note = $db->query('select * from notes where email = :email',[
        'email'=>$emailuser
        ])->findORfail();
    
    
    $heading = "Note";
    require view("notes/show.view.php");
?>