<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ReservationsGetEmail extends AbstractController
{
    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function __invoke(Request $request): iterable
    {
        $parts = explode('/', $request->getPathInfo());
        $email = end($parts);
        return $this->reservationRepository->getByEmail($email);
    }
}
