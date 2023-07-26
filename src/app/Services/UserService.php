<?php

namespace App\Services;

use App\Models\SampleUser;
use Illuminate\Database\Eloquent\Collection;

/**
 * ユーザサービス
 */
class UserService
{
	/**
	 * sample_users TBL全てのデータを取得
	 *
	 * @return Collection
	 */
	public static function getSampleUserAll() : Collection {
    return SampleUser::orderBy('id', 'desc')->get();
	}

	/**
	 * sample_users TBLから特定ユーザ情報を取得
	 *
	 * @return void
	 */
	public static function getSampleUserById(int $userId) {
    return SampleUser::where('id', $userId)->get();
	}
}