<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Token
 * 
 * @property int $id
 * @property int|null $user_id
 * @property string $token
 * @property bool $is_online
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class Token extends Model
{
	protected $table = 'tokens';

	protected $casts = [
		'user_id' => 'int',
		'is_online' => 'bool'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'user_id',
		'token',
		'is_online'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
