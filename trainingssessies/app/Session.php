<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Session
 *
 * @property int $id
 * @property int|null $responsible_id
 * @property int|null $team_id
 * @property int $academy_year_id
 * @property int $status_id
 * @property int $organisation_id
 * @property string|null $date_time
 * @property string $subject
 * @property string|null $file
 * @property string|null $feedback
 * @property int|null $amount_cursisten
 * @property string|null $profile_curstist
 * @property string|null $expected_knowledge
 * @property string|null $goals
 * @property string|null $activities
 * @property string|null $infrastructure_materials
 * @property string|null $responsible_docent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Session newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Session newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Session query()
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereAcademyYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereAmountCursisten($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereExpectedKnowledge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereInfrastructureMaterials($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereOrganisationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereProfileCurstist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereResponsibleDocent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereResponsibleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\AcademyYear $AcademyYear
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DocentSession[] $DocentSessions
 * @property-read int|null $docent_sessions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MissedLesson[] $MissedLessons
 * @property-read int|null $missed_lessons_count
 * @property-read \App\Organisation $Organisation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Preference[] $Preferences
 * @property-read int|null $preferences_count
 * @property-read \App\Status $Status
 * @property-read \App\StudentAcademyYear $StudentAcademyYear
 * @property-read \App\Team|null $Team
 * @property mixed|null $seen
 * @method static \Illuminate\Database\Eloquent\Builder|Session whereSeen($value)
 */
class Session extends Model
{
    public function DocentSessions()
    {
        return $this->hasMany('App\DocentSession');   // a genre has many records
    }

    public function Preferences()
    {
        return $this->hasMany('App\Preference');   // a genre has many records
    }

    public function MissedLessons()
    {
        return $this->hasMany('App\MissedLesson');   // a genre has many records
    }

    public function Team()
    {
        return $this->belongsTo('App\Team')->withDefault();   // a User belongs to a UserKind
    }

    public function StudentAcademyYear()
    {
        return $this->belongsTo('App\StudentAcademyYear')->withDefault();   // a User belongs to a UserKind
    }

    public function AcademyYear()
    {
        return $this->belongsTo('App\AcademyYear')->withDefault();   // a User belongs to a UserKind
    }

    public function Status()
    {
        return $this->belongsTo('App\Status')->withDefault();   // a User belongs to a UserKind
    }

    public function Organisation()
    {
        return $this->belongsTo('App\Organisation')->withDefault();   // a User belongs to a UserKind
    }
}
