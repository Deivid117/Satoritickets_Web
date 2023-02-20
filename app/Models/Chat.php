<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Chat
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Chat extends Model
{
	protected $table = 'chats';

    use HasFactory;

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
    public function messages(){
        return $this->hasMany('App\Models\Message');
    }
}
