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
        Schema::create('sample_users', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('user id');
            $table->string('name')->comment('ユーザ名');
            $table->string('company')->comment('会社名');
            $table->string('post_number')->comment('郵便番号');
            $table->string('address')->comment('住所');
            $table->string('verify_code')->nullable()->comment('認証コード: 認証コード(数値5桁)');
            $table->dateTime('verified_at')->nullable()->comment('認証済日付: 認証コードで認証した日付');
            $table->dateTime('last_used_at')->nullable();
            $table->dateTime('expires_at')->nullable();
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
        Schema::dropIfExists('sample_users');
    }
};
