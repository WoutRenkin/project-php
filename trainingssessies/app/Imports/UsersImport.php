<?php

namespace App\Imports;

use App\AcademyYear;
use App\StudentAcademyYear;
use App\User;
use Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;
use Validator;

class UsersImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsOnError
{
    use Importable,SkipsFailures,SkipsErrors;



    public function collection(Collection $rows)
    {
        $rows = $rows->toArray();
        $errors = []; // array to accumulate errors

        foreach ($rows as $key=>$row){
            $validator = Validator::make($row, $this->rules(), $this->validationMessages());
            if ($validator->fails()) {
                foreach ($validator->errors()->messages() as $messages) {
                    foreach ($messages as $error) {
                        // accumulating errors:
                        $errors[] = $error;
                    }
                }
            }else {
                $user = User::create([
                    'first_name' => $row['voornaam'],
                    'last_name' => $row['achternaam'],
                    'r_number' => $row['r_nummer'],
                    'email' => $row['email'],
                    'tel' => $row['tel'],
                    'user_kind_id' => 1,
                    'password' => Hash::make('secret'),
                    'active' => true,
                ]);

                $user->studentAcademyYears()->create([
                    'academy_year_id' => AcademyYear::whereActive(true)->first()->id
                ]);
            }
    }


    }
    public function onError(Throwable $e)
    {

    }
    public function rules(): array
    {
        return [
            'email' => ['email', 'unique:users,email']
        ];
    }

    public function validationMessages()
    {
        return [
            'email.unique' => trans('email.email_must_be_unique')
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        //dd($failures);
    }
}
