<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate dữ liệu từ form
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email', // Đảm bảo kiểm tra email duy nhất trong bảng users
            'password' => 'required|string|min:8|confirmed',  // Yêu cầu mật khẩu và xác nhận mật khẩu (password_confirmation)
        ]);
        
        // Nếu validate thất bại, trả về lỗi với thông báo chi tiết
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),  // Trả về lỗi chi tiết cho từng trường
            ], 400);
        }
    
        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
        ]);
    
        // Trả về phản hồi thành công
        session()->flash('status', 'Đăng ký thành công!');
        return view('login_register');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Validation input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        // dd($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status' => 'success',
                'message' => 'Đăng nhập thành công!',
                'user' => Auth::user()
            ], 200); // 200 là mã trạng thái OK
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Thông tin đăng nhập không chính xác!'
            ], 401); // 401 là mã lỗi "Unauthorized"
        }
    }

    // Đăng xuất người dùng
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login_index');
    }
}
