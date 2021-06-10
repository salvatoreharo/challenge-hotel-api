<?php

namespace App\Controller;

use App\Entity\Room;
use App\Repository\RoomRepository;

class RoomsTypes
{
    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function __invoke(): iterable
    {
       return $this->roomRepository->getAvailableTypes();
    }
}