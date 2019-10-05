<?php

class User{

    private $db;

    public function __construct() {
        $this->db = mysqli_connect('localhost','root','','ionic-server') or die('Error connecting to MySQL server.');
    }

    function getAll() {
        $query = 'SELECT * FROM users';
        $response = new stdClass();
        $users = array();

        try {
            if($result = mysqli_query($this->db, $query)) {
                $row = mysqli_fetch_array($result);
                while ($row = mysqli_fetch_array($result)) {
                    $user = (object)[
                        'name' => $row['name'],
                        'lastname' => $row['lastname'],
                        'birthday' => $row['birthday'],
                        'image' => $row['image'],
                    ];
                    array_push($users, $user);
                }
                $response = (object) ['users' => $users];
            } else {
                throw Exception($response);
            }
        } catch( Exception $e ) {
            $response = (object) ['error' => $e->getMessage()];
        }

        mysqli_close($this->db);
        return $response;
    }

    function add(String $name, String $lastname, String $image, Int $birthday) {
        $response = new stdClass();
        $query = "INSERT INTO users (name, lastname, image, birthday) VALUES
        ('{$name}', '{$lastname}', '{$image}', {$birthday})";

        if(mysqli_query($this->db, $query)){
            $response = (object) ['success' => true];
        } else{
            $response = (object) [
                'error' => 'Unable to add user',
                'query' => $query,
                'db' => mysqli_error($this->db),
            ];
        }

        mysqli_close($this->db);
        return $response;
    }

}