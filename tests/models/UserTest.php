<?php

namespace models;

use Role;
use User;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;

include 'src/models/Role.php';
include 'src/models/User.php';

#[UsesClass(User::class)]
#[CoversClass(User::class)]
final class UserTest extends TestCase
{
    private $roleAdmin;
    private $roleUser;
    private $userAdmin;
    private $userUser;

    public function setUp(): void {
        $this->roleAdmin = new Role(
            Role::ROLE_ADMIN,
            Uuid::uuid4()->toString()
        );

        $this->roleUser = new Role(
            Role::ROLE_USER,
            Uuid::uuid4()->toString()
        );

        $this->userAdmin = new User(
            "admin",
            "admin@example.com",
            $this->roleAdmin,
            null,
            Uuid::uuid4()->toString(),
            null
        );

        $this->userUser = new User(
            "user",
            "user@example.com",
            $this->roleUser,
            null,
            Uuid::uuid4()->toString(),
            null
        );
    }

    public function testHasRoleTrue() {
        $result = $this->userAdmin->hasRole(Role::ROLE_ADMIN);

        $this->assertEquals(
            true,
            $result,
            'Returns TRUE checking if ADMIN has Role ADMIN'
        );
    }

    public function testHasRoleFalse() {
        $this->assertEquals(
            false,
            $this->userAdmin->hasRole(Role::ROLE_USER),
            'Returns FALSE checking if ADMIN has Role USER'
        );
    }

    public function testIsAdminTrue() {
        $this->assertEquals(
            true,
            $this->userAdmin->isAdmin(),
            'Returns TRUE checking if ADMIN is ADMIN'
        );
    }

    public function testIsAdminFalse() {
        $this->assertEquals(
            false,
            $this->userUser->isAdmin(),
            'Returns FALSE checking if USER is ADMIN'
        );
    }

    public function testIsUserTrue() {
        $this->assertEquals(
            true,
            $this->userUser->isUser(),
            'Returns FALSE checking if USER is USER'
        );
    }

    public function testIsUserFalse() {
        $this->assertEquals(
            false,
            $this->userAdmin->isUser(),
            'Returns FALSE checking if ADMIN is USER'
        );
    }
}
