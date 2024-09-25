<?php

namespace App\Controller;

use App\Token;

use App\Entity\Users;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('api/users')]
    public function index(EntityManagerInterface $entityManager): JsonResponse
    {
        $users = $entityManager->getRepository(Users::class)->findAll();

        return $this->json($users, 200, [], [
            'groups' => ['user.index']
        ]);
    }
    
    #[Route('api/user/show/{id}')]
    public function show(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $users = $entityManager->getRepository(Users::class)->find($id);

        return $this->json($users, 200, [], [
            'groups' => ['user.show']
        ]);
    }

    #[Route('/api/user/inscription')]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {   
        $username = $request->query->get('username');
        $mail = $request->query->get('mail');
        $password = $request->query->get('password');
        $class = $request->query->get('class');

        if ($username != NULL && is_string($username)) {
            $user = new Users();
            $user->setUsername($username);
        }

        if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            if($entityManager->getRepository(Users::class)->findOneBy(['mail' => $mail])){
                return $this->json(['error' => 'Mail already use'], 400);
            }
            $user->setMail($mail);
            }

        if ($password != NULL) {
            $password_hashed = password_hash($password . 'epsi', PASSWORD_BCRYPT, ["cost" => 4]);
            $user->setPassword($password_hashed);
        } else {
            return $this->json(['error' => 'Bad password resquest']);
        }

        if ($class != NULL) {
            $user->setClass($class);
        }
        $user->setStatus('Student');

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['succes' => 'User created'], 201);
    }

    #[Route('/api/user/connexion')]
    public function connexion(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {   
        $username = $request->query->get('username');
        $password = $request->query->get('password');

        $user = $entityManager->getRepository(Users::class)->findOneBy(['username' => $username]);

        if($user == NULL){
            $user = $entityManager->getRepository(Users::class)->findOneBy(['mail' => $username]);
        }

        if ($user == NULL){
            return $this->json(['error' => 'username or mail not found']);
        }

        if (password_verify($password.'epsi', $user->getPassword())) {
            $token = hash('sha256', date("Y-m-d H:i:s").'wis');
        } else {
            return $this->json(['error' => 'Bad password']);
        }

        $user->setToken($token);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['token' => $token]);
    }

    #[Route('/api/user/deconnexion')]
    public function deconnexion(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {   
        $token = $request->query->get('token');
        $user = Token::CheckUser($token, $entityManager);
        if (!$user){
            return $this->json(['error' => 'Token not found'], 400);
        }

        $user->setToken(NULL);

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(['success' => "Disconnected"], 200);
    }

    #[Route('/api/user/edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {   
        $token = $request->query->get('token');
        $id = $request->query->get('id');
        $password = $request->query->get('password');

        $user = Token::CheckUser($token, $entityManager);
        if (!$user){
            return $this->json(['error' => 'Token not found'], 400);
        } else if ($user->getId() != $id){
            return $this->json(['error' => 'Bad permissions'], 401);
        } else if (!password_verify($password.'epsi', $user->getPassword())){
            return $this->json(['error' => 'Bad password'], 401);
        }
        
        $new_password = $request->query->get('new_password');
        $mail = $request->query->get('mail');
        $username = $request->query->get('username');

        if($new_password != NULL){
            $password_hashed = password_hash($new_password . 'epsi', PASSWORD_BCRYPT, ["cost" => 4]);
            $user->setPassword($password_hashed);
        }

        if($mail != NULL && filter_var($mail, FILTER_VALIDATE_EMAIL)){
            $user->setMail($mail);
        }
        if($username != NULL){
            $user->setUsername($username);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json($user, 200, [], [
            'groups' => ['user.profile']
        ]);
    }
}
