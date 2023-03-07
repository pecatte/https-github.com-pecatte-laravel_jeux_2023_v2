<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jeuxuser
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Jeuxcommenter[] $jeuxcommenters
 * @property Collection|Jeuxjeux[] $jeuxjeuxes
 *
 * @package App\Models
 */
class Jeuxuser extends Model
{
	protected $table = 'jeuxusers';

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token'
	];

	public function jeuxcommenters()
	{
		return $this->hasMany(Jeuxcommenter::class, 'id_user');
	}

	public function jeuxjeuxes()
	{
		return $this->hasMany(Jeuxjeux::class, 'id_user');
	}
}
