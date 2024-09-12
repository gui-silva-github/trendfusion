<?php

    require_once("models/User.php");
    require_once("dao/UserRelationDaoMySql.php");
    require_once("dao/PostDaoMySql.php");

    class UserDAOMySQL implements UserDAO{

        private $pdo;

        public function __construct(PDO $driver)
        {   
            $this->pdo = $driver;
        }

        private function generateUser($array, $full  = false){
            $user = new User();

            $user->id = $array['id'] ?? 0;
            $user->email = $array['email'] ?? '';
            $user->name = $array['name'] ?? '';
            $user->password = $array['password'] ?? '';
            $user->birthdate = $array['birthdate'] ?? '';
            $user->city = $array['city'] ?? '';
            $user->work = $array['work'] ?? '';
            $user->avatar = $array['avatar'] ?? '';
            $user->cover = $array['cover'] ?? '';
            $user->token = $array['token'] ?? '';

            if($full){
                $urDaoMySQL = new UserRelationDaoMySql($this->pdo);
                $postDaoMySQL = new PostDaoMySql($this->pdo);

                $user->followers = $urDaoMySQL->getFollowers($user->id);
                foreach($user->followers as $key => $follower_id){
                    $newUser = $this->findById($follower_id);
                    $user->followers[$key] = $newUser;
                }

                $user->following = $urDaoMySQL->getFollowing($user->id);
                foreach($user->following as $key => $following_id){
                    $newUser = $this->findById($following_id);
                    $user->following[$key] = $newUser;
                }

                $user->photos = $postDaoMySQL->getPhotosFrom($user->id);
            }

            return $user;
        }

        public function findByToken($token)
        {
            if(!empty($token)){
                $sql = $this->pdo->prepare("SELECT * FROM users WHERE token = :token");
                $sql->bindValue(':token', $token);
                $sql->execute();

                if($sql->rowCount()>0){
                    $data = $sql->fetch(PDO::FETCH_ASSOC);
                    $user = $this->generateUser($data);
                    return $user;
                }
            }

            return false;
        }

        public function findByEmail($email)
        {
            if(!empty($email)){
                $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
                $sql->bindValue(':email', $email);
                $sql->execute();

                if($sql->rowCount()>0){
                    $data = $sql->fetch(PDO::FETCH_ASSOC);
                    $user = $this->generateUser($data);
                    return $user;
                }
            }

            return false;
        }

        public function findById($id, $full = false)
        {
            if(!empty($id)){
                $sql = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
                $sql->bindValue(':id', $id);
                $sql->execute();

                if($sql->rowCount()>0){
                    $data = $sql->fetch(PDO::FETCH_ASSOC);
                    $user = $this->generateUser($data, $full);
                    return $user;
                }
            }

            return false;
        }

        public function findByName($name){

            $array = [];

            if(!empty($name)){
                $sql = $this->pdo->prepare("SELECT * FROM users WHERE name LIKE :name");
                $sql->bindValue(':name', '%'.$name.'%');
                $sql->execute();

                if($sql->rowCount()>0){
                    $data = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($data as $item){
                        $array[] = $this->generateUser($item);
                    }

                }
            }

            return $array;

        }

        public function update(User $u){

            $sql = $this->pdo->prepare("UPDATE users SET
                email = :email,
                password = :password,
                name = :name,
                birthdate = :birthdate,
                city = :city,
                work = :work,
                avatar = :avatar,
                cover = :cover,
                token = :token
                WHERE id = :id"
            );
            $sql->bindValue(':email', $u->email);
            $sql->bindValue(':password', $u->password);
            $sql->bindValue(':name', $u->name);
            $sql->bindValue(':birthdate', $u->birthdate);
            $sql->bindValue(':city', $u->city);
            $sql->bindValue(':work', $u->work);
            $sql->bindValue(':avatar', $u->avatar);
            $sql->bindValue(':cover', $u->cover);
            $sql->bindValue(':token', $u->token);
            $sql->bindValue(':id', $u->id);

            $sql->execute();

            return true;

        }

        public function insert(User $u){
            $sql = $this->pdo->prepare("INSERT INTO users(email, password, name, birthdate, token) VALUES (:email, :password, :name, :birthdate, :token)");
            $sql->bindValue(':email', $u->email);
            $sql->bindValue(':password', $u->password);
            $sql->bindValue(':name', $u->name);
            $sql->bindValue(':birthdate', $u->birthdate);
            $sql->bindValue(':token', $u->token);
            $sql->execute();

            return true;
        }   

    }

?>