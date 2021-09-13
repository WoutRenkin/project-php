<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\PasswordReset;

/**
 * App\User
 *
 * @property int $id
 * @property int $user_kind_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $r_number
 * @property string|null $tel
 * @property int|null $active
 * @property int|null $reflection_uploaded
 * @property int|null $session_voorstel_uploaded
 * @property int|null $session_aanvraag_uploaded
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereReflectionUploaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSessionAanvraagUploaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSessionVoorstelUploaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTelNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserKindId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\StudentAcademyYear[] $studentAcademyYears
 * @property-read int|null $student_academy_years_count
 * @property-read \App\UserKind $userKind
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTel($value)
 */
class User extends Authenticatable
{
    public function userKind()
    {
        return $this->belongsTo('App\UserKind')->withDefault();   // a User belongs to a UserKind
    }
    public function studentAcademyYears()
    {
        return $this->hasMany('App\StudentAcademyYear', 'student_id');   // a user has many StudentAcademyYears
    }
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','user_kind_id','r_number','tel','active','reflection_uploaded','session_voorstel_uploaded','session_aanvraag_uploaded'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token, $this->email));
    }


}
