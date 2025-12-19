<?php


class CCrud {


    private ?CDatabase $db;
    public function __construct()
    {
        $this->db = CDatabase::getInstance();
    }
    public function GetAll($table){
        $query = "SELECT * FROM " . $table;
        $result = $this->db->QuerySearch($query);
        return $this->db->FetchAll($result);
    }
    public function InsertCornetto($table, $sapore,$prezzo,$data_inserimento){
        $query = "INSERT INTO $table (sapore, prezzo, data_inserimento)
                  VALUES (?, ?, ?)";


        return $this->db->QueryInsert($query, [
            $sapore,
            $prezzo,
            $data_inserimento
        ], "sds");
    }
    public function GetById($id, $table) {
        $query = "SELECT * FROM " . $table . " WHERE id = ?";
        $result = $this->db->QuerySearch($query, [$id], "i");
        return $this->db->FetchAssoc($result);
    }
    public function Delete($id, $table) {
        $query = "DELETE FROM " . $table . " WHERE id = ?";
        return $this->db->QueryInsert($query, [$id], "i");
    }
}

