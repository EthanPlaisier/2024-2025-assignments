<?php
use PHPUnit\Framework\TestCase;
use Login\classes\User;
use Login\classes\Database;

class UserTest extends TestCase {
    private $db;
    private $user;

    protected function setUp(): void {
        $this->db = $this->createMock(Database::class);
        $this->db->method('getConnection')->willReturn($this->createMock(PDO::class));
        $this->user = new User($this->db->getConnection());
    }

    public function testSetPassword() {
        $password = 'test1234';
        $this->user->SetPassword($password);
        $this->assertNotEquals($password, $this->user->GetPassword());
        $this->assertTrue(password_verify($password, $this->user->GetPassword()));
    }

    public function testValidateUser() {
        $this->user->username = '';
        $this->user->SetPassword('');
        $errors = $this->user->ValidateUser();
        $this->assertContains('Invalid username', $errors);
        $this->assertContains('Invalid password', $errors);
    }

    public function testRegisterUserFailsWhenUsernameExists() {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('rowCount')->willReturn(1);
        $this->db->getConnection()->method('prepare')->willReturn($stmtMock);

        $this->user->username = 'existing_user';
        $this->user->SetPassword('password123');
        $this->user->email = 'test@example.com';
        
        $errors = $this->user->RegisterUser();
        $this->assertContains('Username bestaat al.', $errors);
    }

    public function testRegisterUserSucceeds() {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('rowCount')->willReturn(0);
        $stmtMock->method('execute')->willReturn(true);
        $this->db->getConnection()->method('prepare')->willReturn($stmtMock);

        $this->user->username = 'new_user';
        $this->user->SetPassword('password123');
        $this->user->email = 'test@example.com';
        
        $errors = $this->user->RegisterUser();
        $this->assertEmpty($errors);
    }

    public function testLoginUserFailsForInvalidCredentials() {
        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('fetch')->willReturn(false);
        $this->db->getConnection()->method('prepare')->willReturn($stmtMock);
        
        $_POST['password'] = 'wrongpassword';
        $this->user->username = 'nonexistent_user';
        $this->assertFalse($this->user->LoginUser());
    }
}
