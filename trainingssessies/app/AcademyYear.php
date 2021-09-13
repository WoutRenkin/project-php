<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AcademyYear
 *
 * @property int $id
 * @property string $name_year
 * @property int $active
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademyYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademyYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademyYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademyYear whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademyYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademyYear whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademyYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademyYear whereNameYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademyYear whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademyYear whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Session[] $Sessions
 * @property-read int|null $sessions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\StudentAcademyYear[] $StudentAcademyYear
 * @property-read int|null $student_academy_year_count
 */
class AcademyYear extends Model
{
    public function StudentAcademyYear()
    {
        return $this->hasMany('App\StudentAcademyYear');   // a genre has many records
    }

    public function Sessions()
    {
        return $this->hasMany('App\Session');   // a genre has many records
    }
}
