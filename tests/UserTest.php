<?php

use PHPUnit\Framework\TestCase;

include 'src/models/User.php';

final class UserTest extends TestCase
{
    public function testClassConstructor()
    {
        $user = new User(
            'johndoe',
            'johndoe@filmrate.test',
            new Role('admin')
        );

        $this->assertSame('johndoe', $user->getUsername());
        $this->assertSame('johndoe@filmrate.test', $user->getEmail());
    }
}