<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserKind
 *
 * @property int $id
 * @property string $kind_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserKind newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserKind newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserKind query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserKind whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserKind whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserKind whereKindName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserKind whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $Users
 * @property-read int|null $users_count
 */
class UserKind extends Model
{
    public function Users()
    {
        return $this->hasMany('App\User');   // a genre has many records
    }
}
