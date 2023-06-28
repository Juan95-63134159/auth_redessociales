<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\UserController;
use App\Http\IntegrationsSocialNetworkController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Integrations\Facebook;


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'prefix'=>'api',
],function() use ($router){
    $router->get('users', 'UserController@index');


    $router->post('auth-social-network', 'IntegrationsSocialNetworkController@authLogin');
});


// // Ruta para iniciar sesión con Facebook
// $router->get('/auth/facebook', function () use ($router) {
//     $redirect_uri = 'http://localhost:8000/auth/facebook/callback'; // URL de retorno después de la autenticación de Facebook
//     $scope = ['email']; // permisos que se requieren para acceder a la información del usuario

//     $login_url = 'https://www.facebook.com/v12.0/dialog/oauth?client_id=' . '769796031441018' .
//                  '&redirect_uri=' . $redirect_uri .
//                  '&scope=' . implode(',', $scope);

//     return redirect()->to($login_url);
// });

// // Ruta para manejar la respuesta de Facebook después del inicio de sesión
// $router->get('/auth/facebook/callback', function (Request $request) use ($router) {
//     $redirect_uri = 'http://localhost:8000/auth/facebook/callback'; // URL de retorno después de la autenticación de Facebook
//     $app_id = '769796031441018';
//     $app_secret = '1dfb60ea841badbad91202ee0c7e1658';

//     // Obtener el código de autorización de Facebook
//     $code = $request->input('code');

//     // Intercambiar el código de autorización por un token de acceso de larga duración
//     $url = 'https://graph.facebook.com/v12.0/oauth/access_token?' .
//            'client_id=' . $app_id .
//            '&client_secret=' . $app_secret .
//            '&redirect_uri=' . $redirect_uri .
//            '&code=' . $code;
//     $response = json_decode(file_get_contents($url), true);
//     // Obtener los datos del usuario utilizando el token de acceso
//     $url = 'https://graph.facebook.com/me?fields=id,name,email&access_token=' . $response['access_token'];
//     $user_data = json_decode(file_get_contents($url), true);
//     return response()->json($user_data);
//     // Redirigir al usuario a la página de inicio
//     // return redirect()->to(env('APP_URL'));
// });


$router->post('/auth/facebook', function () {
    return Facebook::login();
});

$router->get('/auth/facebook/callback', function (Request $request) {
    return Facebook::callback($request);
});

// $router->post('/auth/facebook', 'IntegrationsSocialNetworkController@login');

// $router->get('/auth/facebook/callback', 'IntegrationsSocialNetworkController@callback');
