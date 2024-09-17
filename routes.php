<?php
 


$router->get('/home','controllers/index.php');
$router->get('/contact','controllers/contact.php');
$router->get('/about','controllers/about.php');
$router->get('/note','controllers/notes/show.php');
$router->get('/notes','controllers/notes/index.php')->only('auth');
$router->get('/notes/show','controllers/notes/show.php')->only('auth');

$router->get('/notes/create','controllers/notes/create.php');
$router->post('/notes/create','controllers/notes/create.php');
$router->get('/register','controllers/registration/create.php')->only('guest');
$router->post('/register','controllers/registration/store.php');
$router->get('/login','controllers/sessions/create.php')->only('guest');
$router->post('/login','controllers/sessions/store.php')->only('guest');
$router->post('/logout','controllers/sessions/destroy.php')->only('auth');
$router->get('/profile','controllers/profile.php')->only('auth');



