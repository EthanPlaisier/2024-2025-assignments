<?php

use PHPUnit\Framework\TestCase;
use Login\classes\User;
use Login\classes\Database;

class UserTest extends TestCase {
    private $db;
    private $user;

    protected function setUp(): void {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function testSetAndGetPassword() {
        $this->user->SetPassword("mypassword123");
        $this->assertTrue(password_verify("mypassword123", $this->user->GetPassword()));
    }

    public function testValidateUserWithEmptyFields() {
        $this->user->username = "";
        $this->user->SetPassword("");
        $errors = $this->user->ValidateUser();
        $this->assertContains("Invalid username", $errors);
        $this->assertContains("Invalid password", $errors);
    }

    public function testRegisterUserSuccess() {
        $this->user->username = "testuser_" . rand(1000, 9999);
        $this->user->email = "test@example.com";
        $this->user->SetPassword("testpass");
        $errors = $this->user->RegisterUser();
        $this->assertEmpty($errors);
    }

    public function testRegisterUserDuplicate() {
        // Aanname: je hebt al een gebruiker "existinguser" in je test database
        $this->user->username = "existinguser";
        $this->user->email = "existing@example.com";
        $this->user->SetPassword("testpass");
        $this->user->RegisterUser(); // eerste keer aanmaken

        $user2 = new User($this->db);
        $user2->username = "existinguser";
        $user2->email = "existing@example.com";
        $user2->SetPassword("testpass");
        $errors = $user2->RegisterUser();
        $this->assertContains("Username bestaat al.", $errors);
    }

    public function testLoginUser() {
        // Aanname: gebruiker met deze naam + wachtwoord bestaat al in DB
        $_POST['password'] = 'testpass';

        $this->user->username = "existinguser";
        $result = $this->user->LoginUser();
        $this->assertTrue($result);
    }

    public function testIsLoggedIn() {
        $_SESSION['user'] = ['username' => 'test'];
        $this->assertTrue($this->user->IsLoggedin());
    }

    public function testGetUser() {
        $_SESSION['user'] = ['username' => 'existinguser'];
        $this->user->GetUser();
        $this->assertEquals("existinguser", $this->user->username);
    }

    public function testShowUser() {
        $this->user->username = "demo";
        $this->user->email = "demo@example.com";
        $this->user->role = "user";

        ob_start();
        $this->user->ShowUser();
        $output = ob_get_clean();

        $this->assertStringContainsString("Username: demo", $output);
        $this->assertStringContainsString("Email: demo@example.com", $output);
        $this->assertStringContainsString("Role: user", $output);
    }
}
