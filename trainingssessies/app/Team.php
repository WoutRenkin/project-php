<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Team
 *
 * @property int $id
 * @property string $name
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $full
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MissedLesson[] $MissedLessons
 * @property-read int|null $missed_lessons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Preference[] $Preferences
 * @property-read int|null $preferences_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Session[] $Sessions
 * @property-read int|null $sessions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\StudentAcademyYear[] $StudentAcademyYears
 * @property-read int|null $student_academy_years_count
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereFull($value)
 */
class Team extends Model
{
    protected $fillable = ['name'];

    public function Preferences()
    {
        return $this->hasMany('App\Preference');   // a user has many StudentAcademyYears
    }
    public function StudentAcademyYears()
    {
        return $this->hasMany('App\StudentAcademyYear');   // a user has many StudentAcademyYears
    }
    public function MissedLessons()
    {
        return $this->hasMany('App\MissedLesson');   // a user has many StudentAcademyYears
    }
    public function Sessions()
    {
        return $this->hasMany('App\Session');   // a user has many StudentAcademyYears
    }


    public function GatherStudents(Team $team)
    {
        $students = [];
        foreach($team->StudentAcademyYears as $student){
            if($student->academyYear->active === 1){
                if($student->user->active == true){
                    $students[] = (Object) $student->user;
                }
            }
        }

        $team["students"] = $students;
        return $team;
    }

    public function GatherSession(Team $team) {
        $academyYear = AcademyYear::where('active', 1)->first();
        $session = Session::where('academy_year_id',$academyYear->id)->where('team_id',$team->id)->first();
        if($session){
            $status = Status::where('id', $session->status_id)->first();

            $team["status"] = $status;
        }
        $team["session"] = $session;
        return $team;
    }

}
