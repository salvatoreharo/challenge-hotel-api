<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use App\Entity\Reservation;
use App\Entity\Room;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const MAX_HOTELS = 3;
    const MAX_HOTEL_ROOMS = 5;

    public function load(ObjectManager $manager)
    {
        $rooms = $this->createHotels($manager);
        $users = $this->createUsers($manager);
        $this->createReservations($manager, $rooms, $users);
    }

    public function createHotels(ObjectManager $manager) {
        $rooms = [];
        for ($i = 1; $i <= self::MAX_HOTELS; $i++) {
            $hotel = new Hotel();
            $hotel->setName('Hotel ' . $i);
            $manager->persist($hotel);
            for ($x = 1; $x <= self::MAX_HOTEL_ROOMS; $x++) {
                $room = new Room();
                $room->setType(Room::TYPES[array_rand(Room::TYPES)]);
                $room->setHotel($hotel);
                $manager->persist($room);
                $rooms[] = $room;
            }
        }
        $manager->flush();
        
        return $rooms;
    }

    public function createUsers(ObjectManager $manager) {
        $users = [];
        for ($i = 1; $i <= 2; $i++) {
            $user = new User();
            $user->setEmail('user+' . intval(time()) . '@gmail.com');
            $manager->persist($user);
            $manager->flush();
            $users[] = $user;
        }

        return $users;
    }

    public function createReservations(ObjectManager $manager, array $rooms, array $users) {
        foreach ($rooms as $room) {
            $makeReservation = array_rand([true, false]);
            if ($makeReservation) {
                $user = $users[array_rand($users)];
                $this->createReservation($manager, $room, $user);
            }
        }
    }

    public function createReservation(ObjectManager $manager, Room $room, User $user) {
        $reservation = new Reservation();
        $reservation->setCreatedAt(new \DateTime());
        $reservation->setUserGuest($user);
        $reservation->setRoom($room);
        $reservation->setIsActive(true);
        $manager->persist($reservation);
        $manager->flush();
    }
}
