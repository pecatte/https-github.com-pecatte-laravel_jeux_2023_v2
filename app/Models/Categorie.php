<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jeuxcategory
 * 
 * @property int $id_categorie
 * @property string $nom_categorie
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Jeuxjeux[] $jeuxjeuxes
 *
 * @package App\Models
 */
class Categorie extends Model
{
	protected $table = 'categories';
	protected $primaryKey = 'id_categorie';

	protected $fillable = [
		'nom_categorie'
	];

	public function jeux()
	{
		return $this->hasMany(Jeu::class, 'id_categorie');
	}
}