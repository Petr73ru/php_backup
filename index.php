<?php
// set up
require __DIR__ . '/vendor/autoload.php';
$app=new Slim\App(['settings' => ['displayErrorDetails' => true]]);
$db;
// templates
$container = $app->getContainer();
$container['view'] = function($container)
{
    $templates = __DIR__ . '/templates/';
    $cache     = __DIR__ . '/tmp/views' ;

    $view = new Slim\Views\Twig($templates/*, compact('cache')*/);
    return $view;
};
// helpers
function db_start_up()
{
    global $db;
    $db  = new PDO("mysql:dbname=codabra;host=127.0.0.1", "root", "qwertyui");    
    $db->exec("use codabra;");
}
function save_new_user($user)
{
    global $db;
    try
    {
        $db->exec('insert into codabra_test (email, password) values ("' .
                  $user['email'] . '","' .
                  password_hash($user['password'], PASSWORD_DEFAULT) .'");'
        );
    } catch (Exception $e) { throw $e; }
}
function check_in_db($user){
    global $db;
    try{       
        $query = $db->query("select * from codabra_test where email like\"" .
                          $user['email'] . "\" LIMIT 1;");
        if (gettype($query) == 'object')
        { return $query-> fetch(PDO::FETCH_ASSOC); } else
        { return false; }
    } catch (Exeption $e) {throw $e;}
};

// routing
$app->get('/', function ($request, $response)
{
    return
        $this->view->render($response, 'Home.twig');
});
$app->get('/page1', function( $request, $response)
{
    return $this->view->render($response, 'Page1.twig');
}
);
$app->get('/page2', function ($request, $response)
{
    return $this->view->render($response, 'Page2.twig');
}
);
$app->post('/login', function ($request, $response, $args){   // --> Why args array is empty?
    $db_result;
    $redirect;
    // call to database
    try
    {
        if (!$db_result = check_in_db($_POST)) {
            save_new_user($_POST);
            $db_result='New user saved!';
            $redirect='/page1';
        } else {
            if( password_verify($_POST['password'], $db_result['password'])){
                $db_result = "Welcom back :  <pre> " . print_r($db_result);
            } else { $db_result = 'Password did not match'; }
        }
    }
    catch (Exception $e) {
        return $response->write("There was error with a sql query : " . $e->getMessage());
    }
    // return $response->write($db_result);
    return $response->withStatus(200)->withHeader('Location', $redirect);
});
//$app->post('/login',)
// host
db_start_up();
$app->run();
