<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_bin';

            $table->increments('id')->unsigned()->comment('user id');
            $table->unsignedTinyInteger('type')->comment('タイプ: 1：アプリ、2：LINE');
            $table->string('state')->comment('ステータス');
            $table->string('plan_type')->unsignedTinyInteger()->comment('プランタイプ: 1:アスリート、2:ヘルスケア');
            $table->string('mail')->string()->nullable()->comment('メール');
            $table->dateTime('mail_change_req')->nullable()->comment('変更希望メール');
            $table->dateTime('mail_verified_at')->nullable()->comment('メール認証日');
            $table->string('password')->nullable()->comment('パスワード');
            $table->string('access_token')->nullable()->comment('アクセストークン');
            $table->dateTime('last_login_date')->nullable()->comment('アクセストークン');
            $table->string('last_name')->nullable()->comment('性');
            $table->string('first_name')->nullable()->comment('名');
            $table->string('display_name')->nullable()->comment('表示名');
            $table->string('sex')->nullable()->comment('性別');
            $table->string('age')->nullable()->comment('年齢');
            $table->string('reason')->nullable()->comment('退会・停止理由');

            $table->string('line_user_id')->nullable()->comment('LINE UserId: ラインユーザのみ');
            $table->string('line_access_token')->nullable()->comment('LINEクセストークン: ラインユーザのみ');
            $table->string('line_refresh_token')->nullable()->comment('LINEリフレッシュトークン: ラインユーザのみ');
            $table->string('line_state')->nullable()->comment('LINEステータス: ラインユーザのみ');
            $table->string('line_picture_url')->nullable()->comment('LINEサムネイル: ラインユーザのみ');
            $table->string('line_error_code')->nullable()->comment('LINEエラーコード: ラインユーザのみ');
            $table->string('line_id_token')->nullable()->comment('LINE IDトークン: ラインユーザのみ');

            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
