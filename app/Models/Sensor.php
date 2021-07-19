<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sensor
 * 
 * @property int $id
 * @property string $name
 * @property int|null $avatar_id
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Avatar|null $avatar
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Sensor extends Model
{
	protected $table = 'sensors';

	protected $casts = [
		'avatar_id' => 'int'
	];

	protected $fillable = [
		'name',
		'avatar_id',
		'description'
	];

	public function avatar()
	{
		return $this->belongsTo(Avatar::class);
	}

//	public function users()
//	{
//		return $this->belongsToMany(User::class, 'user_sensors')
//					->withPivot('id')
//					->withTimestamps();
//	}
}
