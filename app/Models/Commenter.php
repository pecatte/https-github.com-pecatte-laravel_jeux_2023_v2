<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jeuxcommenter
 * 
 * @property string $commentaire
 * @property int $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $id_user
 * @property int $id_jeu
 * 
 * @property Jeuxjeux $jeuxjeux
 * @property Jeuxuser $jeuxuser
 *
 * @package App\Models
 */
class Commenter extends Model
{
	protected $table = 'commenter';
	public $incrementing = false;

	protected $casts = [
		'note' => 'int',
		'id_user' => 'int',
		'id_jeu' => 'int'
	];

	protected $fillable = [
		'commentaire',
		'note'
	];

	public function jeux()
	{
		return $this->belongsTo(Jeu::class, 'id_jeu');
	}

	public function users()
	{
		return $this->belongsTo(User::class, 'id_user');
	}
}