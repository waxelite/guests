<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuestRequest;
use App\Http\Resources\GuestResource;
use App\Services\GuestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GuestController extends Controller
{
    private GuestService $guestService;

    public function __construct(GuestService $guestService)
    {
        $this->guestService = $guestService;
    }

    /**
     * Возвращает список всех гостей.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $guests = $this->guestService->getAll();

        return GuestResource::collection($guests);
    }

    /**
     * Возвращает данные конкретного гостя.
     *
     * @param int $id
     * @return GuestResource|JsonResponse
     */
    public function show(int $id): GuestResource|JsonResponse
    {
        $guest = $this->guestService->getById($id);

        if (!$guest) {
            return response()->json(['error' => 'Guest not found'], 404);
        }

        return new GuestResource($guest);
    }

    /**
     * Создаёт нового гостя.
     *
     * @param Request $request
     * @return GuestResource|JsonResponse
     */
    public function store(Request $request): GuestResource|JsonResponse
    {
        $validator = GuestRequest::validateCreate($request);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $guest = $this->guestService->create($request->all());

        return new GuestResource($guest);
    }

    /**
     * Обновляет данные гостя.
     *
     * @param Request $request
     * @param int $id
     * @return GuestResource|JsonResponse
     */
    public function update(Request $request, int $id): GuestResource|JsonResponse
    {
        $validator = GuestRequest::validateUpdate($request, $id);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $guest = $this->guestService->update($id, $request->all());

        if (!$guest) {
            return response()->json(['error' => 'Guest not found'], 404);
        }

        return new GuestResource($guest);
    }

    /**
     * Удаляет гостя.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->guestService->delete($id);

        if (!$deleted) {
            return response()->json(['error' => 'Guest not found'], 404);
        }

        return response()->json(['message' => 'Guest deleted successfully']);
    }
}
