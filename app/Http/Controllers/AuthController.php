<?php namespace LaravelAcl\Http\Controllers;

use Illuminate\Http\Request;
use Sentry, Redirect, App, Config;
use LaravelAcl\Authentication\Validators\ReminderValidator;
use LaravelAcl\Library\Exceptions\JacopoExceptionsInterface;
use LaravelAcl\Authentication\Services\ReminderService;
use Toast;
use View;
use Illuminate\Support\Facades\Auth;
use LaravelAcl\Store;
use Session;
class AuthController extends Controller {

    protected $authenticator;
    protected $reminder;
    protected $reminder_validator;

    public function __construct(ReminderService $reminder, ReminderValidator $reminder_validator)
    {
        $this->authenticator = App::make('authenticator');
        $this->reminder = $reminder;
        $this->reminder_validator = $reminder_validator;
    }

    public function getClientLogin()
    {

        if (Auth::check()) {
          if(Auth::user()->type==Config::get('constants.Users.TDF Manager')) {
            return redirect('/allDeliveryHistory');
          }
            return redirect('/dashboard');
        }
        return view('client.home.home');
    }
    public function postClientLogin(Request $request)
    {
        list($email, $password, $remember) = $this->getLoginInput($request);
        try
        {
            $credientials=array(
                "email" => $email,
                "password" => $password,
                'activated'=> "1");
            if(Auth::attempt($credientials))
            {
                $storeId=Auth::user()->store_id;
                $getStoreName=Store::find($storeId);
                Session::put('store_name',$getStoreName['store_name']);
                if(Auth::user()->type=='TDF Manager'){
                    return redirect::to('/allDeliveryHistory');
                }else{
                    return redirect::to('/dashboard');
                }
            }
            else
            {
                Toast::error('Login Fail');
                return redirect::to('/');
            }
        }
        catch(JacopoExceptionsInterface $e)
        {
            $errors = $this->authenticator->getErrors();

            return redirect()->route("user.login")->withInput()->withErrors($errors);
        }

    }

    /**
     * Logout utente
     *
     * @return string
     */
    public function getLogout()
    {
        $this->authenticator->logout();

        return redirect('/admin/login');
    }
    public function getClientLogout()
    {
        Auth::logout();
        return redirect('/');
    }
    /**
     * Recupero password
     */
    public function getReminder()
    {
        return view("laravel-authentication-acl::client.auth.reminder");
    }

    /**
     * Invio token per set nuova password via mail
     *
     * @return mixed
     */
    public function postReminder(Request $request)
    {
        $email = $request->get('email');

        try
        {
            $this->reminder->send($email);
            return redirect()->route("user.reminder-success");
        }
        catch(JacopoExceptionsInterface $e)
        {
            $errors = $this->reminder->getErrors();
            return redirect()->route("user.recovery-password")->withErrors($errors);
        }
    }

    public function getChangePassword(Request $request)
    {
        $email = $request->get('email');
        $token = $request->get('token');

        return view("laravel-authentication-acl::client.auth.changepassword", array("email" => $email, "token" => $token) );
    }

    public function postChangePassword(Request $request)
    {
        $email = $request->get('email');
        $token = $request->get('token');
        $password = $request->get('password');

        if (! $this->reminder_validator->validate($request->all()) )
        {
          return redirect()->route("user.change-password")->withErrors($this->reminder_validator->getErrors())->withInput();
        }

        try
        {
            $this->reminder->reset($email, $token, $password);
        }
        catch(JacopoExceptionsInterface $e)
        {
            $errors = $this->reminder->getErrors();
            return redirect()->route("user.change-password")->withErrors($errors);
        }

        return redirect()->route("user.change-password-success");

    }

    /**
     * @return array
     */
    private function getLoginInput(Request $request)
    {
        $email    = $request->get('email');
        $password = $request->get('password');
        $remember = $request->get('remember');

        return array($email, $password, $remember);
    }
}
