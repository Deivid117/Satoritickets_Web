<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tickets
 *
 * @property int $status
 */

class Tickets extends Model
{
    protected $table = 'tickets';

    public $timestamps = false;

    protected $fillable = [
        //'id',
        'no_ticket',
        'project',
        'team',
        'date',
        'user_id',
        'content',
        'creator_id',
        'pdf',
        'status'
    ];
}
