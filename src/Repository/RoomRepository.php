<?php

namespace App\Repository;

use App\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Room|null find($id, $lockMode = null, $lockVersion = null)
 * @method Room|null findOneBy(array $criteria, array $orderBy = null)
 * @method Room[]    findAll()
 * @method Room[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Room::class);
    }

    public function getAvailableTypes($hotelId)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("
            SELECT hotel.id hotelId, hotel.name hotelName, room.id roomId, room.type roomType, COUNT(room.type) total
            FROM App\Entity\Room room
            JOIN room.hotel hotel
            LEFT JOIN room.reservations reservation WITH reservation.isActive = 1
            WHERE hotel.id = ?1 AND reservation is NULL
            GROUP BY room.type
        ");
        $query->setParameter(1, $hotelId);
        return $query->getResult();
    }

    public function getAvailableRoom($hotelId, $roomType)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("
            SELECT room
            FROM App\Entity\Room room
            LEFT JOIN room.reservations reservation WITH reservation.isActive = 1
            WHERE room.hotel = ?1 AND reservation is NULL AND room.type = ?2
        ");
        $query->setParameter(1, $hotelId);
        $query->setParameter(2, $roomType);
        $query->setMaxResults(1);
        return $query->getOneOrNullResult();
    }

}
