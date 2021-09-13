<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Preference
 *
 * @property int $id
 * @property int $team_id
 * @property int $session_id
 * @property int $ranking
 * @property int|null $is_chosen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Preference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Preference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Preference query()
 * @method static \Illuminate\Database\Eloquent\Builder|Preference whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preference whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preference whereIsChosen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preference whereRanking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preference whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preference whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Preference whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Session $Session
 * @property-read \App\Team $Team
 */
class Preference extends Model
{
    public function Team()
    {
        return $this->belongsTo('App\Team')->withDefault();   // a User belongs to a UserKind
    }

    public function Session()
    {
        return $this->belongsTo('App\Session')->withDefault();   // a User belongs to a UserKind
    }
}
