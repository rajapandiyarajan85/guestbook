<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
#use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
	private $userDummyData;
	
	private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
	
    public function load(ObjectManager $manager)
    {
		$this->userDummyData = [
            // $userData = [$fullname, $password, $email, $roles];
            ['Raja Admin', 'Test@123', 'admin@yahoo.com', ['ROLE_ADMIN']],            
            ['Raja User', 'Test@123', 'user@yahoo.com', ['ROLE_USER']],
        ];
		foreach ($this->userDummyData as [$name,$password, $email, $roles]) {
            $user = new User();
            $user->setName($name); 
			$user->setEmail($email);			
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));            
            $user->setRoles($roles);

            $manager->persist($user);            
        }
        $manager->flush();
    }
}
