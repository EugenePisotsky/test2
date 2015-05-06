<?php
/*
 * Модель с пользователями
 */
class UsersTable extends AppModel {
    public function getUserById($id) {
        $query = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $query->execute([
            $id
        ]);

        return $query->fetch();
    }

    public function insert($params) {
        array_walk_recursive($params, function (&$value) {
            $value = htmlentities($value);
        });

        $query = $this->pdo->prepare('INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)');
        $query->execute($params);
    }

    public function check($params) {
        $query = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');
        $query->execute([
            $params['email']
        ]);

        $res = $query->fetch();

        if ($res && password_verify($params['password'], $res['password'])) {
            return $res['id'];
        }

        return false;
    }

    public function checkEmail($email) {
        $query = $this->pdo->prepare('SELECT id FROM users WHERE email = ?');
        $query->execute([
            $email
        ]);

        $res = $query->fetch();

        if ($res) {
            return false;
        }

        return true;
    }
}