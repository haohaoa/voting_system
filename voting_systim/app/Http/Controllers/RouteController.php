<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RouteController extends Controller
{
    public function index()
    {

        // if (Auth::check() && Auth::user()->decentralization == 1 ) {
        //     return redirect()->route('organization');
        // }
        if (Auth::check()) {
            $candidates = DB::table('candidates')->get();
            // dd($candidates); // Lấy tất cả dữ liệu từ bảng candidates
            return view('home', compact('candidates'));  // Truyền dữ liệu vào view
        } else {
            return redirect()->route('login');
        }
    }
    public function organization()
    {
        if (Auth::check() && Auth::user()->decentralization == 1) {
            return view('organization');
        }else{
            return redirect()->route('home')->with('error', 'Bạn không phải là người tổ chức.');
        }
    }
}
