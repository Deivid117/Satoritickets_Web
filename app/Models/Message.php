<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 *
 * @property int $id
 * @property string|null $content
 * @property int|null $seen_message
 * @property int|null $sender_id
 * @property int|null $receiver_id
 * @property int|null $chat_id
 * @property string|null $message_date
 * @property string|null $message_hour
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Message extends Model
{
	protected $table = 'messages';

	protected $casts = [
		'sender_id' => 'int',
		'chat_id' => 'int'
	];

	protected $fillable = [
		'content',
		'seen_message',
		'sender_id',
		'receiver_id',
		'chat_id',
		'message_date',
		'message_hour'
	];
}
