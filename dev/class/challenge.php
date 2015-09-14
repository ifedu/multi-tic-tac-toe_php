<?php
class Challenge {
    function __construct($bd) {
        $this->bd = $bd;
    }

    // private function login_error() {
    //     $json = json_encode(array(
    //         'action' => 'login',
    //         'login' => 'error'
    //     ));

    //     echo $_GET['callback']."(".$json.");";
    // }

    // private function login_ok($user) {
    //     $img = (is_file('assets/' . $user . '/img.png') == true) ? 'assets/' . $user . '/img.png' : '';

    //     $json = json_encode(array(
    //         'action' => 'login',
    //         'img' => $img,
    //         'login' => 'ok'
    //     ));

    //     echo $_GET['callback'].'('.$json.');';
    // }

    // private function noExists ($user, $pass) {
    //     $sql = $this->bd->prepare(
    //         'SELECT COUNT(*) AS num
    //         FROM users
    //         WHERE name LIKE ?
    //         AND password LIKE ?'
    //     );

    //     $sql->execute(array($user, $pass));
    //     $r = $sql->fetch(PDO::FETCH_ASSOC);

    //     ($r['num'] == 0) ? $this->login_error() : $this->login_ok($user);
    // }

    private function exists($sw) {
        echo json_encode(array(
            'user' => $sw
        ));
    }

    public function checkUser($user) {
        $sql = $this->bd->prepare(
            'SELECT COUNT(*) AS num
            FROM users
            WHERE name LIKE ?'
        );

        $sql->execute(array($user));
        $r = $sql->fetch(PDO::FETCH_ASSOC);

        ($r['num'] > 0) ? $this->exists(true) : $this->exists(false);
    }

    // public function insert($user, $pass) {
    //     $sql = $this->bd->prepare(
    //         'INSERT INTO users (name, password)
    //         VALUES (?, ?)'
    //     );

    //     $sql->execute(array($user, $pass));

    //     $this->login_ok($user);
    // }
}
?>