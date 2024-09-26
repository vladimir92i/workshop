<?php

namespace App;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;

class Token {
    public static function CheckUser(string $token, EntityManagerInterface $entityManager) {
        $user = $entityManager->getRepository(Users::class)->findOneBy(['token' => $token]);

        if ($user == NULL){
            return false;
        } else {
            return $user;
        }
    }

    public static function Permission(string $token, string $role, EntityManagerInterface $entityManager) {
        $user = $entityManager->getRepository(Users::class)->findOneBy(['token' => $token]);

        if ($user == NULL){
            return false;
        } else if ($user->getStatus() != $role){
            return false;
        } else {
            return $user;
        }
    }
}