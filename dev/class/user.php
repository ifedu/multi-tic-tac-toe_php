<?php
class User {
    function __construct($bd) {
        $this->bd = $bd;
    }

    //PRIVATE
    private function login_error() {
        $json = json_encode(array(
            'action' => 'login',
            'login' => 'error'
        ));

        echo $_GET['callback']."(".$json.");";
    }

    private function login_ok($user) {
        $img = (is_file("assets/$user/img.png") == true) ? 'assets/' . $user . '/img.png' : '';

        $json = json_encode(array(
            'action' => 'login',
            'img' => $img,
            'login' => 'ok'
        ));

        echo $_GET['callback'].'('.$json.');';
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

        ($r['num'] == 0) ? $this->login_error() : $this->login_ok($user);
    }

    private function modal() {
        $json = json_encode(array(
            'action' => 'insert'
        ));

        echo $_GET['callback'].'('.$json.');';
    }

    //PUBLICç
    public function checkUser($user, $pass) {
        $sql = $this->bd->prepare(
            'SELECT COUNT(*) AS num
            FROM users
            WHERE name LIKE ?'
        );

        $sql->execute(array($user));
        $r = $sql->fetch(PDO::FETCH_ASSOC);

        ($r['num'] == 0) ? $this->modal() : $this->login($user, $pass);
    }

    public function insert($user, $pass) {
        $sql = $this->bd->prepare(
            'INSERT INTO users (name, password)
            VALUES (?, ?)'
        );

        $sql->execute(array($user, $pass));

        $this->login_ok($user);
    }

    public function upload($user) {
        if (is_dir('assets') == false) {
            mkdir('assets');
        }

        if (is_dir('assets/' . $user) == false) {
            mkdir('assets/' . $user);
        }

        if (isset($_FILES['file'])) {
            move_uploaded_file($_FILES['file']['tmp_name'], 'assets/' . $user . '/img.png');

            echo $_FILES['file']['tmp_name'];
        }
    }
}
?>