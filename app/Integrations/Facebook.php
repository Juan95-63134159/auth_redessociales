<?php
namespace App\Integrations;

class Facebook
{
    //
    public static function get_redirect(){
        $redirect_uri = 'http://localhost:8000/auth/facebook/callback'; // URL de retorno después de la autenticación de Facebook
        $scope = ['email']; // permisos que se requieren para acceder a la información del usuario

        $login_url = 'https://www.facebook.com/v12.0/dialog/oauth?client_id=' . '769796031441018' .
                     '&redirect_uri=' . $redirect_uri .
                     '&scope=' . implode(',', $scope);

        return $login_url;  // return 'inicio session con facebook';
    }
    
    public static function login(){
        $redirect_uri = 'http://localhost:8000/auth/facebook/callback'; // URL de retorno después de la autenticación de Facebook
        $scope = ['email']; // permisos que se requieren para acceder a la información del usuario

        $login_url = 'https://www.facebook.com/v12.0/dialog/oauth?client_id=' . '769796031441018' .
                     '&redirect_uri=' . $redirect_uri .
                     '&scope=' . implode(',', $scope);

        return redirect()->to($login_url);  // return 'inicio session con facebook';
    }

    public static function callback($request)
    {
        $redirect_uri = 'http://localhost:8000/auth/facebook/callback'; // URL de retorno después de la autenticación de Facebook
        $app_id = '769796031441018';
        $app_secret = '1dfb60ea841badbad91202ee0c7e1658';

        // Obtener el código de autorización de Facebook
        $code = $request->input('code');

        // Intercambiar el código de autorización por un token de acceso de larga duración
        $url = 'https://graph.facebook.com/v12.0/oauth/access_token?' .
               'client_id=' . $app_id .
               '&client_secret=' . $app_secret .
               '&redirect_uri=' . $redirect_uri .
               '&code=' . $code;
        $response = json_decode(file_get_contents($url), true);

        // Obtener los datos del usuario utilizando el token de acceso
        $url = 'https://graph.facebook.com/me?fields=id,name,email&access_token=' . $response['access_token'];
        $user_data = json_decode(file_get_contents($url), true);

        return response()->json($user_data);
        

        // Redirigir al usuario a la página de inicio
        // return redirect()->to(env('APP_URL'));
    }

    public static function logout(){}


}
