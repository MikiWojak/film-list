<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;
use Ramsey\Uuid\Uuid;

require_once 'Database.php';
require_once 'src/models/Role.php';
require_once 'src/models/User.php';
require_once 'src/repositories/Repository.php';
require_once 'src/repositories/UserRepository.php';

#[UsesClass(UserRepository::class)]
#[CoversClass(UserRepository::class)]
final class UserRepositoryTest extends TestCase
{
    private $roleAdmin;
    private $roleUser;

    private $userRepository;
    private $databaseMock;

    protected function setUp(): void
    {
        $this->roleAdmin = new Role(
            Role::ROLE_ADMIN,
            Uuid::uuid4()->toString()
        );

        $this->roleUser = new Role(
            Role::ROLE_USER,
            Uuid::uuid4()->toString()
        );

        $this->databaseMock = $this->createMock(Database::class);

        $this->setDatabaseMockInstance();

        $this->userRepository = new UserRepository();

        $reflection = new ReflectionClass($this->userRepository);
        $property = $reflection->getProperty('database');
        $property->setAccessible(true);
        $property->setValue($this->userRepository, $this->databaseMock);
    }

    private function setDatabaseMockInstance(): void
    {
        $databaseClass = new ReflectionClass(Database::class);
        $instanceProperty = $databaseClass->getProperty('instance');
        $instanceProperty->setAccessible(true);
        $instanceProperty->setValue(null, $this->databaseMock);
    }

    public function testFindAll(): void
    {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('fetchAll')->willReturn([
            [
                'id' => Uuid::uuid4()->toString(),
                'username' => 'john',
                'email' => 'john@filmrate.test',
                'roleId' => $this->roleAdmin->getId(),
                'roleName' => $this->roleAdmin->getName(),
                'createdAt' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => Uuid::uuid4()->toString(),
                'username' => 'jane',
                'email' => 'jane@filmrate.test',
                'roleId' => $this->roleUser->getId(),
                'roleName' => $this->roleUser->getName(),
                'createdAt' => date('Y-m-d H:i:s'),
            ]
        ]);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $this->databaseMock->method('connect')->willReturnSelf();
        $this->databaseMock->method('disconnect')->willReturnSelf();
        $this->databaseMock->method('getConnection')->willReturn($pdoMock);

        $users = $this->userRepository->findAll();

        $this->assertCount(2, $users);
        $this->assertInstanceOf(User::class, $users[0]);
        $this->assertInstanceOf(User::class, $users[1]);

        // @TODO Does array contain proper user
    }

    public function testFindAllEmpty(): void
    {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('fetchAll')->willReturn([]);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $this->databaseMock->method('connect')->willReturnSelf();
        $this->databaseMock->method('disconnect')->willReturnSelf();
        $this->databaseMock->method('getConnection')->willReturn($pdoMock);

        $users = $this->userRepository->findAll();

        $this->assertCount(0, $users);
    }

    public function testFindByUsername(): void
    {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('fetch')->willReturn([
            'id' => Uuid::uuid4()->toString(),
            'username' => 'john',
            'email' => 'john@filmrate.test',
            'roleId' => $this->roleAdmin->getId(),
            'roleName' => $this->roleAdmin->getName(),
            'createdAt' => date('Y-m-d H:i:s'),
        ]);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $this->databaseMock->method('connect')->willReturnSelf();
        $this->databaseMock->method('disconnect')->willReturnSelf();
        $this->databaseMock->method('getConnection')->willReturn($pdoMock);

        $user = $this->userRepository->findByUsername('john');

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('john', $user->getUsername());
    }

    public function testFindByUsernameNotFound(): void
    {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('fetch')->willReturn(false);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $this->databaseMock->method('connect')->willReturnSelf();
        $this->databaseMock->method('disconnect')->willReturnSelf();
        $this->databaseMock->method('getConnection')->willReturn($pdoMock);

        $user = $this->userRepository->findByUsername('john');

        $this->assertNull($user);
    }

    public function testFindByUsernameWithPassword(): void
    {
        $hashedPassword = password_hash('Qwerty123!', PASSWORD_DEFAULT);

        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('fetch')->willReturn([
            'id' => Uuid::uuid4()->toString(),
            'username' => 'john',
            'email' => 'john@filmrate.test',
            'roleId' => $this->roleAdmin->getId(),
            'roleName' => $this->roleAdmin->getName(),
            'createdAt' => date('Y-m-d H:i:s'),
            'password' => $hashedPassword
        ]);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $this->databaseMock->method('connect')->willReturnSelf();
        $this->databaseMock->method('disconnect')->willReturnSelf();
        $this->databaseMock->method('getConnection')->willReturn($pdoMock);

        $user = $this->userRepository->findByUsername('john', true);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('john', $user->getUsername());
        $this->assertEquals($hashedPassword, $user->getPassword());
    }

    public function testFindByEmail(): void
    {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('fetch')->willReturn([
            'id' => Uuid::uuid4()->toString(),
            'username' => 'john',
            'email' => 'john@filmrate.test',
            'roleId' => $this->roleAdmin->getId(),
            'roleName' => $this->roleAdmin->getName(),
            'createdAt' => date('Y-m-d H:i:s'),
        ]);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $this->databaseMock->method('connect')->willReturnSelf();
        $this->databaseMock->method('disconnect')->willReturnSelf();
        $this->databaseMock->method('getConnection')->willReturn($pdoMock);

        $user = $this->userRepository->findByEmail('john@filmrate.test');

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('john@filmrate.test', $user->getEmail());
    }

    public function testFindByEmailNotFound(): void
    {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('fetch')->willReturn(false);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $this->databaseMock->method('connect')->willReturnSelf();
        $this->databaseMock->method('disconnect')->willReturnSelf();
        $this->databaseMock->method('getConnection')->willReturn($pdoMock);

        $user = $this->userRepository->findByEmail('john@filmrate.test');

        $this->assertNull($user);
    }

    public function testFindByEmailWithPassword(): void
    {
        $hashedPassword = password_hash('Qwerty123!', PASSWORD_DEFAULT);

        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('fetch')->willReturn([
            'id' => Uuid::uuid4()->toString(),
            'username' => 'john',
            'email' => 'john@filmrate.test',
            'roleId' => $this->roleAdmin->getId(),
            'roleName' => $this->roleAdmin->getName(),
            'createdAt' => date('Y-m-d H:i:s'),
            'password' => $hashedPassword
        ]);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $this->databaseMock->method('connect')->willReturnSelf();
        $this->databaseMock->method('disconnect')->willReturnSelf();
        $this->databaseMock->method('getConnection')->willReturn($pdoMock);

        $user = $this->userRepository->findByEmail('john@example.com', true);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('john@filmrate.test', $user->getEmail());
        $this->assertEquals($hashedPassword, $user->getPassword());
    }

    public function testCreate(): void
    {
        $user = new User('john', 'john@filmrate.test', $this->roleUser, 'Qwerty123!');

        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $this->databaseMock->method('connect')->willReturnSelf();
        $this->databaseMock->method('disconnect')->willReturnSelf();
        $this->databaseMock->method('getConnection')->willReturn($pdoMock);

        $this->userRepository->create($user);

        $this->assertTrue(true);
    }

    public function testCreateFail(): void
    {
        $user = new User('john', 'john@filmrate.test', $this->roleUser, 'Qwerty123!');

        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willThrowException(new PDOException('Insert failed'));

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $this->databaseMock->method('connect')->willReturnSelf();
        $this->databaseMock->method('disconnect')->willReturnSelf();
        $this->databaseMock->method('getConnection')->willReturn($pdoMock);

        $this->expectException(PDOException::class);
        $this->expectExceptionMessage('Insert failed');

        $this->userRepository->create($user);
    }

    public function testDelete(): void
    {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willReturn(true);

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $this->databaseMock->method('connect')->willReturnSelf();
        $this->databaseMock->method('disconnect')->willReturnSelf();
        $this->databaseMock->method('getConnection')->willReturn($pdoMock);

        $this->userRepository->delete(Uuid::uuid4()->toString());

        $this->assertTrue(true);
    }

    public function testDeleteNonExistent(): void
    {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('execute')->willThrowException(new PDOException('Delete failed'));

        $pdoMock = $this->createMock(PDO::class);
        $pdoMock->method('prepare')->willReturn($stmtMock);

        $this->databaseMock->method('connect')->willReturnSelf();
        $this->databaseMock->method('disconnect')->willReturnSelf();
        $this->databaseMock->method('getConnection')->willReturn($pdoMock);

        $this->expectException(PDOException::class);
        $this->expectExceptionMessage('Delete failed');

        $this->userRepository->delete(Uuid::uuid4()->toString());
    }
}
