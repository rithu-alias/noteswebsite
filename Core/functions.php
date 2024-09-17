<?php 
    use Core\Response;
    function dd($value){
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
        die();
    }
    function urli($value){
        return $_SERVER['REQUEST_URI'] === $value;
    }
    function abort($code = 404){
        http_response_code($code);
        require base_path("views/{$code}.php");
    }
    function authorize($condition,$status = Response::FORBIDDEN){
        if(!$condition){
            abort($status);
        }
    }
    function base_path($path){
        return BASE_PATH . $path;
    }
    function view($path){
        return base_path('views/'.$path);
    }
    function login($user){
        $_SESSION['user'] =[
            'email'=>$user['email']
        ];
        session_regenerate_id(true);
    }
    function logout(){
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID','',time()-3600,$params['path'],$params['domain']);

    }
?>