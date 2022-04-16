<?php

namespace Model;

class User extends ActiveRecord
{
    // database
    protected static $table = 'users';
    protected static $columnsDB = ['id', 'name', 'lastname', 'email', 'password', 'phone', 'admin',
        'confirmed', 'token'];

    // attributes
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $phone;
    public $admin;
    public $confirmed;
    public $token;

    // constructor
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->lastname = $args['lastname'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->confirmed = $args['confirmed'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    // validation messages for create an account
    public function newAccountValidation()
    {
        if (!$this->name) {
            self::$alerts['error'][] = "Customer name is required";
        }
        if (!$this->lastname) {
            self::$alerts['error'][] = "Customer lastname is required";
        }
        if (!$this->phone) {
            self::$alerts['error'][] = "Customer phone is required";
        }
        if (!$this->email) {
            self::$alerts['error'][] = "Customer email is required";
        }
        if (!$this->password) {
            self::$alerts['error'][] = "Customer password is required";
        }
        if (strlen($this->password) < 8) {
            self::$alerts['error'][] = "The password must have a minimum of 8 characters";
        }

        return self::$alerts;
    }

    public function loginValidation()
    {
        if (!$this->email){
            self::$alerts['error'][] = "Email is necessary";
        }
        if (!$this->password){
            self::$alerts['error'][] = "Password is necessary";
        }
        return self::$alerts;
    }

    public function emailValidation()
    {
        if (!$this->email){
            self::$alerts['error'][] = "Email is necessary";
        }
        return self::$alerts;
    }
    public function passwordValidation()
    {
        if (!$this->password) {
            self::$alerts['error'][] = "Customer password is required";
        }
        if (strlen($this->password) < 8) {
            self::$alerts['error'][] = "The password must have a minimum of 8 characters";
        }
        return self::$alerts;
    }

    public function userExists()
    {
        $query = " SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";

        $result = self::$db->query($query);
        if ($result->num_rows) {
            self::$alerts['error'][] = "User already existss";
        }
        return $result;

    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function generateToken()
    {
        $this->token = uniqid();
    }

    public function checkPasswordAndValidation($password)
    {
        $result = password_verify($password, $this->password);
        if (!$result || !$this->confirmed){
            self::$alerts['error'][] = "invalid password or unconfirmed email";
        }else{
            return true;
        }
    }

}
