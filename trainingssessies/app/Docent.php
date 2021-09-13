<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Docent
 *
 * @property int $id
 * @property string $name
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Docent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Docent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Docent query()
 * @method static \Illuminate\Database\Eloquent\Builder|Docent whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Docent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Docent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Docent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Docent whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DocentSession[] $DocentSessions
 * @property-read int|null $docent_sessions_count
 */
class Docent extends Model
{
    protected $fillable = ['name'];

    public function DocentSessions()
    {
        return $this->hasMany('App\DocentSession');   // a genre has many records
    }
}
