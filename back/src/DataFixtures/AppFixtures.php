<?php

namespace App\DataFixtures;

use App\Entity\Room;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 10 rooms for floor 1
        for ($i = 0; $i < 10; $i++) {
            $room = new Room();
            $room->setName(100 + $i);
            $room->setCapacity(10 + $i);
            $room->setFloor(1);
            $manager->persist($room);
        }
        // create 10 rooms for floor 2
        for ($i = 0; $i < 10; $i++) {
            $room = new Room();
            $room->setName(200 + $i);
            $room->setCapacity(10 + $i);
            $room->setFloor(2);
            $manager->persist($room);
        }
        //create user
        for ($i=0; $i < 3;$i++){
            $user = new Users();
            $user->setClass("devIA");
            if($i== 1){
                $user->setStatus("admin");
            }else{
                $user->setStatus("eleve");
            }
            $user->setPassword("epsi123");
            $user->setUsername("utilisateur");
            $manager->persist($user);
        }

        $manager->flush();
    }
}
// pour lancer :php bin/console doctrine:fixtures:load