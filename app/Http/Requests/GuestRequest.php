<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestRequest
{
    /**
     * Список поддерживаемых стран.
     */
    private static array $allowedCountries = [
        'ru',
        'us',
        'gb',
        'de',
        'fr',
    ];

    /**
     * Валидация для создания гостя.
     */
    public static function validateCreate(Request $request): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phone' => 'required|string|unique:guests,phone',
            'email' => 'required|email|unique:guests,email',
            'country' => [
                'nullable',
                'string',
                'in:' . implode(',', self::$allowedCountries),
            ],
        ], self::messages());
    }

    /**
     * Валидация для обновления гостя.
     */
    public static function validateUpdate(Request $request, int $guestId): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'phone' => 'required|string|unique:guests,phone,' . $guestId,
            'email' => 'required|email|unique:guests,email,' . $guestId,
            'country' => [
                'nullable',
                'string',
                'in:' . implode(',', self::$allowedCountries),
            ],
        ], self::messages());
    }

    /**
     * Сообщения об ошибках.
     */
    private static function messages(): array
    {
        $allowedCountries = implode(', ', self::$allowedCountries);

        return [
            'country.in' => "The country must be one of the following: $allowedCountries.",
        ];
    }
}
