<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DocentSession
 *
 * @property int $id
 * @property int $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DocentSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocentSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocentSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocentSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocentSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocentSession whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocentSession whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Session $Session
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|DocentSession whereName($value)
 */
class DocentSession extends Model
{
    public function Session()
    {
        return $this->belongsTo('App\Session')->withDefault();   // a User belongs to a UserKind
    }
}
