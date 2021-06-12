<?php

namespace App\Service;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;

class ReservationService {
    private $em;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->em = $entityManagerInterface;
    }

    public function create($user, $room) {
        $reservation = new Reservation();
        $reservation->setUserGuest($user);
        $reservation->setRoom($room);
        $reservation->setCreatedAt(new \DateTime());
        $reservation->setIsActive(true);
        $this->em->persist($reservation);
        $this->em->flush();
        
        return $reservation;
    }
}