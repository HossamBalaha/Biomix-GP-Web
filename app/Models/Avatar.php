<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Avatar
 * 
 * @property int $id
 * @property string $path
 * @property string|null $extension
 * @property float $size
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Sensor[] $sensors
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class Avatar extends Model
{
	protected $table = 'avatars';

	protected $casts = [
		'size' => 'float'
	];

	protected $fillable = [
		'path',
		'extension',
		'size'
	];

	public function sensors()
	{
		return $this->hasMany(Sensor::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
