<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserSensorReading
 * 
 * @property int $id
 * @property int|null $user_sensor_id
 * @property float $reading
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property UserSensor|null $user_sensor
 *
 * @package App\Models
 */
class UserSensorReading extends Model
{
	protected $table = 'user_sensor_readings';

	protected $casts = [
		'user_sensor_id' => 'int',
		'reading' => 'float'
	];

	protected $fillable = [
		'user_sensor_id',
		'reading'
	];

	public function user_sensor()
	{
		return $this->belongsTo(UserSensor::class);
	}
}
