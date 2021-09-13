<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Organisation
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $tel_number
 * @property string $contact_person
 * @property string|null $description
 * @property string|null $place
 * @property string|null $address
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation whereTelNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Organisation whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Session[] $Sessions
 * @property-read int|null $sessions_count
 */
class Organisation extends Model
{
    protected $fillable = ['name', 'contact_person', 'email', 'tel_number', 'place', 'address', 'description'];

    public function Sessions()
    {
        return $this->hasMany('App\Session');
    }
}
