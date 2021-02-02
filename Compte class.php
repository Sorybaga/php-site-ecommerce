<?php 

class Account {
    public $id;
    public $username;
    private $password;
    public $created;

    function __construct($username, $password) {
        echo "Test constructor called";
        $this->username = $username;
        $this->setPassword($password);
        $this->created = date('Y-m-d H:i:s');
    }

    function setPassword($password) {
        $this->password = hash('sha256', $password);
    }

    function getPassword() {
        return $this->password;
    }

    public static function generateAccount() {
        return new Account("testor", random_int(0,100));
    }
}

?>