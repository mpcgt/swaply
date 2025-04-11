<?php

namespace App\Tests\Entity;

use App\Entity\Users;
use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
{
    public function testEmail()
    {
        $user = new Users();
        $user->setEmail('test@swaply.com');

        $this->assertEquals('test@swaply.com', $user->getEmail());
    }
}
