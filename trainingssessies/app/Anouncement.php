<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Anouncement
 *
 * @property int $id
 * @property string|null $date
 * @property mixed|null $file
 * @property string $message
 * @property string $subject
 * @property string|null $recipients
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Anouncement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Anouncement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Anouncement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Anouncement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anouncement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anouncement whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anouncement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anouncement whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anouncement whereRecipients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anouncement whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anouncement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Anouncement extends Model
{
    //
}
