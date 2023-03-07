<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jeuxjeux
 * 
 * @property int $id_jeu
 * @property string $nom_jeu
 * @property string $logo_jeu
 * @property int $nb_joueurs
 * @property Carbon $temps_partie
 * @property string $regles
 * @property string $materiel
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $id_user
 * @property int $id_categorie
 * 
 * @property Jeuxcategory $jeuxcategory
 * @property Jeuxuser $jeuxuser
 * @property Collection|Jeuxcommenter[] $jeuxcommenters
 *
 * @package App\Models
 */
class Jeu extends Model
{
	protected $table = 'jeux';
	protected $primaryKey = 'id_jeu';

	protected $casts = [
		'nb_joueurs' => 'int',
		'id_user' => 'int',
		'id_categorie' => 'int'
	];

	protected $dates = [
		'temps_partie'
	];

	protected $fillable = [
		'nom_jeu',
		'logo_jeu',
		'nb_joueurs',
		'temps_partie',
		'regles',
		'materiel',
		'id_user',
		'id_categorie'
	];

	public function categories()
	{
		return $this->belongsTo(Categorie::class, 'id_categorie');
	}

	public function users()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function commenters()
	{
		return $this->hasMany(Commenter::class, 'id_jeu');
	}
}