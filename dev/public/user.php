<?php
class User {
    private $bd;

    function __construct($bd) {
        $this->bd = $bd;
    }

    private function login ($user, $pass) {
        $sql = $this->bd->prepare(
            'SELECT COUNT(*) AS num
            FROM users
            WHERE name LIKE ?
            AND password LIKE ?'
        );

        $sql->execute(array($user, $pass));
        $r = $sql->fetch(PDO::FETCH_ASSOC);

        if ($r['num'] == 0) {
            echo 'pass incorrecto';
        } else {
            echo 'login';
        }
    }

    public function checkUser($user, $pass) {
        $sql = $this->bd->prepare(
            'SELECT COUNT(*) AS num
            FROM users
            WHERE name LIKE ?'
        );

        $sql->execute(array($user));
        $r = $sql->fetch(PDO::FETCH_ASSOC);

        if ($r['num'] == 0) {
            echo 'insert';
        } else {
            $this->login($user, $pass);
        }
    }

    public function insert($user, $pass) {
        $sql = $this->bd->prepare(
            'INSERT INTO users (name, password)
            VALUES (?, ?)'
        );

        $sql->execute(array($user, $pass));
    }
}
?>