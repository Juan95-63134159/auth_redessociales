<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Integrations\Facebook;
use App\Integrations\Google;
use App\Integrations\MailChimp;

class Integration extends Model
{
    //
    protected $table = 'integrations';

    protected $fillable  = [
        'name_app',
        'url_app',
        'description'
    ];

    public static function integrationAuthLogin($data){
        $result = [];
        switch(strtolower($data->name_app)){
            case 'facebook':
                $result = Facebook::login();
                break;
            case 'google':
                $result = Google::login();
                break;
            case 'mailchimp';
                $result = MailChimp::login();
                break;
            default:
                $result = false;
                break;
        }
        
        return $result;
    }
    


}
