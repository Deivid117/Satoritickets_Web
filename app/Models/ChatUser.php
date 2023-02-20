<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChatUser
 * 
 * @property int $id
 * @property int $user_id
 * @property int $chat_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ChatUser extends Model
{
	protected $table = 'chat_user';

	protected $casts = [
		'user_id' => 'int',
		'chat_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'chat_id'
	];
}
