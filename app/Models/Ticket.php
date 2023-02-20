<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * 
 * @property int $id
 * @property int|null $no_ticket
 * @property string|null $project
 * @property string|null $team
 * @property string|null $date
 * @property string|null $content
 * @property int|null $user_id
 * @property int $creator_id
 * @property string|null $pdf
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Ticket extends Model
{
	protected $table = 'tickets';

	protected $casts = [
		'no_ticket' => 'int',
		'user_id' => 'int',
		'creator_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'no_ticket',
		'project',
		'team',
		'date',
		'content',
		'user_id',
		'creator_id',
		'pdf',
		'status'
	];
}
