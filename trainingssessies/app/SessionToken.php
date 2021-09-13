<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SessionToken
 *
 * @property int $id
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SessionToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SessionToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SessionToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|SessionToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SessionToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SessionToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SessionToken whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SessionToken extends Model
{
    //
}
