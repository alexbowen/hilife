<?php
class Database {

    public $connection;

    function __construct($host, $name, $user, $pass) {
        $this->connection = new PDO('mysql:host=' . $host . ';dbname=' . $name, $user, $pass);
    }

    function query($query) {
        return $this->connection->query($query);
    }

    function prepare($sql, $options = []) {
        return $this->connection->prepare($sql, $options);
    }

    function execute($statement, $params) {
        $statement->execute($params);

        if (constant("DEBUG_SQL") === true) {
            $statement->debugDumpParams();
        }
    }
}

$database = new Database(constant("DB_HOST"), constant("DB_NAME"), constant("DB_USER"), constant("DB_PASS"));
?>
