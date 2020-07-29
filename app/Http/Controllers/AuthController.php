<?php

namespace App\Http\Controllers;

use App\Link;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /*** Метод для отображения формы ***/
    public function registerForm()
    {
        return view('auth.register');
    }

    /*** Метод для регистрации и аутентификации пользователей ***/
    public function register(Request $request)
    {
        $new_user = null;
        // Валидация средствами ларавел
        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required|min:10'
        ]);

        // Дополнительная валидация поля "номер телефона"
        $pattern = $re = '/^\+{0,1}\d+\({0,1}\d+\){0,1}\d+\-{0,1}\d+\-{0,1}\d+$/m';
        if(!preg_match($pattern, $request->get('phone_number'))) {
            return redirect()->back()->withErrors( 'The phone number does not match the pattern');
        }

        // Проверяем есть ли пользователи с таким именем и номером телефона
        $user = User::all()
            ->where('name', $request->get('name'))
            ->where('phone_number', $request->get('phone_number'))
            ->first();

        // Если пользователь нашелся мы его аутентифицируем,
        // В противном случае регистрируем, затем аутентифицируем
        // И перенаправляем его на стартовую страницу "кабинет"
        if(empty($user)) {
            $new_user = User::add($request->all());
            Auth::login($new_user);
            $link = Link::add([
                'link' => time(),
                'user_id' => $new_user->id,
                'is_active' => Link::ACTIVE_MODE
            ]);
            return redirect('/cabinet');
        } elseif($user->name == $request->name && $user->phone_number == $request->phone_number) {
            Auth::login($user);
            return redirect('/cabinet');
        } else {
            return redirect()->back()->withErrors( 'User already exists');
        }
    }

    /*** Метод для выхода из системы как аутентифицированый пользователь ***/
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/register');
    }
}
