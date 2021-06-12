<?php

namespace App\Controller;

use App\Repository\RoomRepository;
use App\Service\ReservationService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ReservationsPostUser extends AbstractController
{
    private $roomRepository;
    private $userService;
    private $reservationService;

    public function __construct(RoomRepository $roomRepository, UserService $userService, ReservationService $reservationService)
    {
        $this->roomRepository = $roomRepository;
        $this->userService = $userService;
        $this->reservationService = $reservationService;
    }

    public function __invoke(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $room = $this->roomRepository->getAvailableRoom($data['hotelId'], $data['roomType']);
        $user = $this->userService->getOrCreateUser($data['email']);
        $reservation = $this->reservationService->create($user, $room);

        return $reservation;
    }
}