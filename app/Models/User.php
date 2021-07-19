<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $id
 * @property string $full_name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int|null $avatar_id
 * @property string|null $gender
 * @property string|null $role
 * @property Carbon|null $birth_date
 * @property string|null $phone_number
 * @property string|null $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Avatar|null $avatar
 * @property Collection|Token[] $tokens
 * @property Collection|UserAnalysis[] $user_analyses
 * @property Collection|Sensor[] $sensors
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    protected $casts = [
        'avatar_id' => 'int'
    ];
    protected $dates = [
        'birth_date'
    ];
    protected $fillable = [
        'full_name',
        'username',
        'email',
        'password',
        'avatar_id',
        'gender',
        'role',
        'birth_date',
        'phone_number',
        'address'
    ];
    protected $hidden = [
        'password'
    ];
    protected $table = 'users';

    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }

    public function sensors()
    {
        return $this->hasMany(UserSensor::class);
    }

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function user_analyses()
    {
        return $this->hasMany(UserAnalysis::class);
    }
}
