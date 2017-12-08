* SINGLE AUTH :


*. avoid home.blade.php file auth+layouts folder


* Create Index by defaultStringLength :
  
  https://laravel.com/docs/master/migrations#creating-indexes

  app\provider\appserviceprovider.php :

  use Illuminate\Support\Facades\Schema;

  public function boot(){
  
    Schema::defaultStringLength(191);
  
  }

 

*. php artisan make:auth

   php artisan migrate






-> ADD EXTRA FIELD FOR REGISTRATION :


   add phone number	
	
   1. add field in database

   2. app\user add field in protected $fillable

   3. view (copy any part)
   
   4. add field in app\http\controller\auth\registercontroller.php (in protected function create)
  


   

-> SET CUSTOM ERROR :


any view under homecontroller will be auth

   <strong>

	{{ $errors->first('email') }}

        // set what u want

  </strong>





-> CHANGE credentials ERROR :

   resources/lang/en/auth.php 
   
   application/language/en/validation.php (change built in error)


-> any view under homecontroller will be auth


-> RECOVERY PASSWORD :

   turn on less secure apps :

   go to this link https://myaccount.google.com/security#connectedapps



-> Google apps setting :

   https://support.google.com/accounts/answer/185833?hl=en

   turn on 2-Step-Verification || Visit your App passwords page & create apps



   

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=mail address
MAIL_PASSWORD=apppassword
MAIL_ENCRYPTION=tls 



-> confiq/auth.php :

    'stream' => [
        'ssl' => [
            'allow_self_signed' => true,
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ],




-> Reset Password link :

   go to : vendor/laravel/framework/src/Illuminate/Auth/Notifications/ResetPassword.php
   
   public function toMail
   set this 	-> 	action('Reset Password', url(config('app.url').route('password.reset', $this->token, false)))
   to 		-> 	action('Reset Password', url('/').route('password.reset', $this->token, false))
   
   
-> Reset Heaader Footer :

   php artisan vendor:publish --tag=laravel-mail
   
   customize it : resources/views/vendor/mail/html
   
   
   

Auth Undo :


auth/login.blade.php
auth/register.blade.php
auth/passwords/email.blade.php
auth/passwords/reset.blade.php
layouts/app.blade.php
home.blade.php
web/route.php (remove auth route)
delete database tables (related to auth)
confiq/auth.php	 (reset guard | provider | password array)






___________________________________________________________






-> composer require hesto/multi-auth

-> app/Providers/AppServiceProvider.php add this :

   Create Index by defaultStringLength :
   
   https://laravel.com/docs/master/migrations#creating-indexes
  

   use Illuminate\Support\Facades\Schema;

    public function boot(){
    
       Schema::defaultStringLength(191);
    
    }
	
    public function register(){
    
	if ($this->app->environment() == 'local') {
		$this->app->register('Hesto\MultiAuth\MultiAuthServiceProvider');
	}
   }
	

-> Create Admin :

   php artisan multi-auth:install admin -f
   php artisan multi-auth:install employee -f
   php artisan multi-auth:install customer -f


-> php artisan migrate	

-> For Secure any page create AdminAuthController or CustomerAuthController in app\http\controller


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function ViewScat(){
	return view('admin.subcategory');
    }
}



-> ADD EXTRA FIELD FOR REGISTRATION :


   add phone number	
	
   1. add field in database

   2. app\user add field in protected $fillable

   3. view (copy any part)
   
   4. add field in app\http\controller\auth\registercontroller.php (in protected function create)
  


   

-> SET CUSTOM ERROR :


any view under homecontroller will be auth

   <strong>

	{{ $errors->first('email') }}

        // set what u want

  </strong>

  
https://laravel.com/docs/5.5/validation

*. 'phone' => 'required|regex:/(01)[0-9]{9}/',

*. password =/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/

   

*. password_confirmation match auto with password


-> CHANGE credentials ERROR :


   resources/lang/en/auth.php


any view under homecontroller will be auth




-> RECOVERY PASSWORD :

turn on less secure apps :

go to this link https://myaccount.google.com/security#connectedapps



go to this link generate password :

https://support.google.com/accounts/answer/185833?hl=en

turn on 2-Step-Verification || Visit your App passwords page & create apps



MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=mail address
MAIL_PASSWORD=apppassword
MAIL_ENCRYPTION=tls 




-> Reset Password link :

   go to : vendor/laravel/framework/src/Illuminate/Auth/Notifications/ResetPassword.php
   
   public function toMail
   set this 	-> 	action('Reset Password', url(config('app.url').route('password.reset', $this->token, false)))
   to 		-> 	action('Reset Password', url('/').route('password.reset', $this->token, false))
   
   
-> Reset Heaader Footer :

   php artisan vendor:publish --tag=laravel-mail
   
   customize it : resources/views/vendor/mail/html
   
   
