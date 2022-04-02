<?php
class Database {

    public $connection;

    function __construct($host, $name, $user, $pass) {
        $this->connection = new PDO('mysql:host=' . $host . ';dbname=' . $name, $user, $pass);
    }

    function query($query) {
        return $this->connection->query($query);
    }

    function prepare($sql, $extra) {
        return $this->connection->prepare($sql, $extra);
    }

    function execute($statement, $params) {
        $statement->execute($params);
    }
}

$database = new Database(constant("DB_HOST"), constant("DB_NAME"), constant("DB_USER"), constant("DB_PASS"));
?>
