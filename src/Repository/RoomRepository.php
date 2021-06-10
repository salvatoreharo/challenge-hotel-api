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

    public function getAvailableTypes()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("
            SELECT hotel.id hotelId, hotel.name hotelName, room.id roomId, room.type roomType
            FROM App\Entity\Room room
            JOIN room.hotel hotel
            LEFT JOIN room.reservations reservation WITH reservation.isActive = 1
            WHERE reservation is NULL 
            GROUP BY room.type
        ");
        return $query->getResult();
    }

}
