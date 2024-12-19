<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->string('name'); // Tên ứng viên
            $table->text('program')->nullable(); // Chương trình hành động (có thể null)
            $table->integer('vote_count')->default(0); // Số phiếu bầu, mặc định là 0
            $table->timestamp('start_time')->nullable(); // Thời gian bắt đầu bỏ phiếu
            $table->timestamp('end_time')->nullable(); // Thời gian kết thúc bỏ phiếu
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
};
