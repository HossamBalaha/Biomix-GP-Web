<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSensor
 * 
 * @property int $id
 * @property int|null $user_id
 * @property int|null $sensor_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Sensor|null $sensor
 * @property User|null $user
 * @property Collection|UserSensorReading[] $user_sensor_readings
 *
 * @package App\Models
 */
class UserSensor extends Model
{
	protected $table = 'user_sensors';

	protected $casts = [
		'user_id' => 'int',
		'sensor_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'sensor_id'
	];

	public function sensor()
	{
		return $this->belongsTo(Sensor::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function user_sensor_readings()
	{
		return $this->hasMany(UserSensorReading::class);
	}
}
