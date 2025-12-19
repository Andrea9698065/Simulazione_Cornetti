<?php
class CDatabase {

    private $connection;
    private $host;
    private $dbname;
    private $username;
    private $password;

    private static ?CDatabase $instance = null;

    private function __construct()
    {
        $this->host = DB_HOST;
        $this->dbname = DB_NAME;
        $this->username = DB_USER;
        $this->password = DB_PASS;

        $this->connect();
    }


    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new CDatabase();
        }

        return self::$instance;

    }
    public function connect() {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
        if (!$this->connection) {
            die("Connection failed: " .mysqli_connect_error());
        }
        mysqli_set_charset($this->connection, "utf8mb4");
    }
    public function Query(string $query, array $params = [], string $types = "")
    {
        $stmt = mysqli_prepare($this->connection, $query);
        if (!$stmt) {
            die("Errore query: " . mysqli_error($this->connection));
        }

        if (!empty($params)) {
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }

        mysqli_stmt_execute($stmt);


        if (stripos($query, 'SELECT') === 0) {
            return mysqli_stmt_get_result($stmt);
        }


        return mysqli_stmt_affected_rows($stmt) > 0;
    }
    public function FetchAssoc($result) {
        if ($result) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }
    public function FetchAll($result){
        $rows = [];
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

}