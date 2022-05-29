<?php

class MPosition extends CI_Model {
    static $REQUIRED_COLS = [
        "name"
    ];
    static $SAFE_COLS = [
        "id",
        "name"
    ];
    static $UPDATE_COLS = [
        "name"
    ];

    public function __construct() {
        parent::__construct();
    }

    public function fetch_positions(){
        $cols = implode(", ", MPosition::$SAFE_COLS);
        $sql = "SELECT {$cols} FROM position";
        $query = $this->db->query($sql);
        $results = $query->result_array();
        return $results;
    }
}
?>
