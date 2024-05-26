<?php

use PHPUnit\Framework\TestCase;

include 'src/models/User.php';

final class UserTest extends TestCase
{
    // @TODO Prepare Users for tests

    // @TODO hasRole - true
    // @TODO hasRole - false

    // @TODO isAdmin - true
    // @TODO isAdmin - false

    // @TODO isUser - true
    // @TODO isUser - false
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