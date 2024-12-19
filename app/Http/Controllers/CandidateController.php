<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    // Hiển thị form tạo ứng viên mới
    public function create()
    {
        return view('candidates.create');
    }

    // Xử lý form lưu ứng viên vào cơ sở dữ liệu
    public function store(Request $request)
    {
        DB::table('candidates')->delete();
        $candidates = json_decode($request->candidates, true);
        foreach ($candidates as $candidate) {
            DB::table('candidates')->insert([
                'name' => $candidate,  // Tên ứng viêns
                'program' => $request->voting_description ?? null, // Mô tả chương trình
                'vote_count' => 0, // Mặc định là 0
                'start_time' =>$request->start_date, // Thời gian bắt đầu
                'end_time' =>$request->end_date, // Thời gian kết thúc
                'created_at' => now(), // Thêm thời gian tạo
                'updated_at' => now(), // Thêm thời gian cập nhật
            ]);
        }

        return response()->json([
            'message' => 'Ứng viên đã được tạo thành công!',
            'data' => $candidates
        ], 201); 
    
    }


    public function update(Request $request)
    {
        // Lấy ID của candidate từ request
        $candidateId = $request['candidateId'];

        // Tìm candidate theo ID
        $candidate = DB::table('candidates')->where('id', $candidateId)->first();

        // Kiểm tra nếu candidate không tồn tại
        if (!$candidate) {
            return response()->json(['message' => 'Candidate not found'], 404);
        }

        // Cập nhật vote_count bằng cách sử dụng update()
        DB::table('candidates')
            ->where('id', $candidateId)
            ->increment('vote_count'); // Tăng 1 vote_count

        // Trả về phản hồi
        return response()->json(['message' => 'Vote added successfully'], 200);
    }
}
