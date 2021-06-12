<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function getByEmail(string $email)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("
            SELECT hotel.name hotelName, room.type roomType, reservation.createdAt
            FROM App\Entity\Reservation reservation
            JOIN reservation.userGuest user
            JOIN reservation.room room
            JOIN room.hotel hotel
            WHERE user.email = ?1
        ");
        $query->setParameter(1, $email);
        return $query->getResult();
    }

}
