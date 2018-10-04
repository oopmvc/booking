<?php

class TopicData {

    protected $connection = null;

    public function connect() {
        $this->connection = new PDO("mysql:host=localhost;dbname=mauriziobarbershop", "admin", "admin");
    }

    public function getAllTopics() {
        $sql = "SELECT * FROM resources";
        $query = $this->connection->prepare($sql);
        $query->execute();
        return $query;
    }

    public function getTopic($id) {
        $sql = "SELECT * FROM resources WHERE id_resource = :id";
        $query = $this->connection->prepare($sql);
        $values = [':id' => $id];
        $query->execute($values);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function listTopic() {

    }

    public function addTopic() {
        $sql = "INSERT INTO resources (fist_name, last_name, description)
            VALUES (:fist_name, :last_name, :description)";
        $query = $this->connection->prepare($sql);
        $data = [
            ':fist_name' => $data['fist_name'],
            ':last_name' => $data['last_name'],
            ':description' => $data['description']
        ];
        $query->execute($data);
    }

    public function editTopic() {

    }

    public function deleteTopic() {

    }

}

?>
