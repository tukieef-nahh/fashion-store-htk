<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    public function login(Request $request)
    {
        // Xác thực người dùng
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Kiểm tra quyền is_admin của người dùng
            if (Auth::user()->is_admin == 1) {
                return redirect()->route('sanpham.index');
            } else {
                return redirect('/home');
            }
        }

        // Trả về lỗi nếu xác thực thất bại
        return redirect()->back()->withErrors(['message' => 'Thông tin đăng nhập không chính xác']);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/dang-nhap')->with('success', 'Bạn đã đăng xuất thành công!');
    }
    
}
