<?php

namespace App\Services;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Collection;

class GuestService
{
    /**
     * Получить всех гостей.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Guest::all();
    }

    /**
     * Получить гостя по ID.
     *
     * @param int $id
     * @return Guest|null
     */
    public function getById(int $id): ?Guest
    {
        return Guest::find($id);
    }

    /**
     * Создать нового гостя.
     *
     * @param array $data
     * @return Guest
     */
    public function create(array $data): Guest
    {
        if (!isset($data['country'])) {
            $data['country'] = $this->getCountryByPhone($data['phone']);
        }

        return Guest::create($data);
    }

    /**
     * Обновить данные гостя.
     *
     * @param int $id
     * @param array $data
     * @return Guest|null
     */
    public function update(int $id, array $data): ?Guest
    {
        $guest = Guest::find($id);

        if (!$guest) {
            return null;
        }

        $guest->update($data);

        return $guest;
    }

    /**
     * Удалить гостя.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $guest = Guest::find($id);

        return $guest ? $guest->delete() : false;
    }

    /**
     * Определить страну по номеру телефона.
     *
     * @param string $phone
     * @return string
     */
    private function getCountryByPhone(string $phone): string
    {
        $country = null;

        if (str_starts_with($phone, '+7')) {
            $country = 'ru';
        } elseif (str_starts_with($phone, '+1')) {
            $country = 'us';
        } elseif (str_starts_with($phone, '+44')) {
            $country = 'gb';
        } elseif (str_starts_with($phone, '+49')) {
            $country = 'de';
        } elseif (str_starts_with($phone, '+33')) {
            $country = 'fr';
        }

        return $country;
    }
}
