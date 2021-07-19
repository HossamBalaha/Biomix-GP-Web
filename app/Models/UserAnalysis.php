<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserAnalysis
 * 
 * @property int $id
 * @property int|null $user_id
 * @property string $symptoms
 * @property string $disease
 * @property string $approach
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class UserAnalysis extends Model
{
	protected $table = 'user_analyses';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'symptoms',
		'disease',
		'approach'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
