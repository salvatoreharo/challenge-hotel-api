<?php

namespace App\Controller;

use App\Entity\Room;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RoomsTypes extends AbstractController
{
    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function __invoke(int $hotelId): iterable
    {
       return $this->roomRepository->getAvailableTypes($hotelId);
    }
}