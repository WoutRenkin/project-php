<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\StudentAcademyYear
 *
 * @property int $id
 * @property int $student_id
 * @property int|null $team_id
 * @property int $academy_year_id
 * @property mixed|null $reflection_verslag
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAcademyYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAcademyYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAcademyYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAcademyYear whereAcademyYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAcademyYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAcademyYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAcademyYear whereReflectionVerslag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAcademyYear whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAcademyYear whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentAcademyYear whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\AcademyYear $academyYear
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Session[] $sessions
 * @property-read int|null $sessions_count
 * @property-read \App\Team|null $team
 * @property-read \App\User $user
 */
class StudentAcademyYear extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'student_id')->withDefault();   // a StudentAcademyYear belongs to a User
    }
    public function team()
    {
        return $this->belongsTo('App\team')->withDefault();   // a StudentAcademyYear belongs to a Team
    }
    public function academyYear()
    {
        return $this->belongsTo('App\AcademyYear')->withDefault();   // a StudentAcademyYear belongs to a AcademyYear
    }
    public function sessions()
    {
        return $this->hasMany('App\Session');   // a StudentAcademyYear has many sessions
    }

    protected $fillable = [
        'student_id','team_id', 'academy_year_id'
    ];

    protected $appends = ['in_active_year'];

    public function getInActiveYearAttribute(){
        //has to be in this class because I use left join
        $active_year = AcademyYear::whereActive(true)->first()->id;
        $in_year = StudentAcademyYear::where('student_id',$this->student_id)
            ->where('academy_year_id',$active_year)
            ->first();
        if($in_year){
            return true;
        }
        return(false);
    }
}
