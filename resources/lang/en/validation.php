<?php

return [

    'required' => 'The :attribute field is required.',
    'string' => 'The :attribute field must be a string.',
    'numeric' => 'The :attribute field must be a number.',
    'digits' => 'The :attribute field must be :digits digits.',
    'unique' => 'The :attribute has already been taken.',
    'min' => [
        'numeric' => 'The :attribute field must be at least :min.',
        'file' => 'The :attribute field must be at least :min kilobytes.',
        'string' => 'The :attribute field must be at least :min characters.',
        'array' => 'The :attribute field must have at least :min items.',
    ],

    'attributes' => [
        'name' => 'name',
        'password' => 'password',
        'password_confirmation' => 'password confirmation',

        'ktp_name' => 'name according to ID card',
        'nik' => 'NIK',
        'phone' => 'phone number',
        'ktp_address' => 'ID card address',
        'rt_rw' => 'RT/RW',
        'kelurahan_desa' => 'village',
        'kecamatan' => 'district',

        'occupation' => 'occupation',

    ],

];