<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MissedLesson
 *
 * @property int $id
 * @property int $team_id
 * @property int $session_id
 * @property string $course
 * @property string $docent_name
 * @property string $lesblok
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MissedLesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MissedLesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MissedLesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|MissedLesson whereCourse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissedLesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissedLesson whereDocentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissedLesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissedLesson whereLesblok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissedLesson whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissedLesson whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MissedLesson whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Session $Session
 * @property-read \App\Team $Team
 */
class MissedLesson extends Model
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
