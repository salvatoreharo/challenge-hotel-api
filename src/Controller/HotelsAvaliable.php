<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Repository\HotelRepository;

class HotelsAvaliable
{
    private $hotelRepository;

    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function __invoke(): iterable
    {
       return $this->hotelRepository->getAvaliable();
    }
}