<?php

namespace App\Http\Controllers\Auth;

use App\Activity;
use App\Helpers\_Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Pin;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	protected function credentials(Request $request)
	{
	    return $request->only($this->username(), 'password');
	}

	/**
	 * Validate the user login request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return void
	 */
	protected function validateLogin(Request $request)
	{
	    $this->validate($request, [
		$this->username() => 'required|string',
		'password' => 'required|string',
	    ]);
	}

    public function username()
    {
        return 'username';
    }

    public function login(LoginRequest $request)
    {
        if(! $this->checkIfAdmin($request->username)){
            // Check user's pin
            if( $pin = Pin::wherePin($request->pin)->first() ){
                $pin->delete();
            }else{
                $this->addLogPinError($request->username);
                return back()->withErrors(['Пин код устарел. Введите новый ПИН код.']);
            }
        }

        $cred = $request->only('username', 'password');
        if( Auth::attempt($cred) ){
            $this->activity(Auth::user());
            $this->addLog(Auth::id());
            return redirect($this->redirectTo);
        }

        $this->passwordErrorLog($request->username);

        return back()->withErrors('Please, Check Email or Password');

    }

    public function checkIfAdmin($username)
    {
        $temp_user = User::where(['username' => $username])->firstOrFail();
        if($temp_user->role == 'admin')
            return true;
        return false;
    }

    public function addLog($user_id)
    {
        $log = _Helper::addLog($user_id, 'Вход пользователя в систему');
    }

    public function addLogPinError($username)
    {
        if( $user = User::where(['username' => $username])->first() )
            $log = _Helper::addLog($user->id, 'Ошибка пин кода', 'Ошибка');

        return true;
    }

    public function passwordErrorLog($username)
    {
        if( $user = User::where(['username' => $username])->first() ) {
            $log = _Helper::addLog($user->id, 'Неправильный пароль', 'Ошибка');
        }else{
            $log = _Helper::addLogWithoutUserId('Неправильный пароль для ' . $email);
        }

        return true;
    }

    // Activities
    public function activity($user)
    {
        $act = new Activity();
        $act->user_id = $user->id;
        $act->ip = '92.24.24.24.24.2.4';
        $act->save();
        return;
    }

    // Logout
    public function logout()
    {
        _Helper::addLog(Auth::id(), 'Выход из системы');
        Auth::logout();
        return redirect('/');
    }
}
