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
    public function QuerySearch($query, $params = [], $types = ""){
        if (!$this->connection) {
            die("Query di ricerca fallita ; Connessione  NON FUNZIONANTE");
        }
        $stmt = mysqli_prepare($this->connection, $query);
        if(!$stmt) {
            die("Errore nella query : " . mysqli_error($this->connection));
        }


        if(!empty($params)) {
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }

        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);

    }
    public function QueryInsert($query, $params = [], $types = ""){
        if (!$this->connection) {
            die("Errore: nessuna connessione attiva");
        }

        $stmt = mysqli_prepare($this->connection, $query);

        if(!$stmt) {
            die("Errore nella preparazione della query: " . mysqli_error($this->connection));
        }

        if(!empty($params)) {
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }

        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $success;
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