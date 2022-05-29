<?php

class MApplication extends CI_Model {
    static $REQUIRED_COLS = [
        "email",
        "position",
        "phone",
        "birthyear"
    ];
    static $SAFE_COLS = [
        "id",
        "email",
        "position",
        "phone",
        "birthyear",
        "created_at"
    ];
    static $UPDATE_COLS = [
        "email",
        "position",
        "phone",
        "birthyear"
    ];
    static $MINI_COLS = [
        "id",
        "created_at",
        "email",
        "position"
    ];

    public function __construct() {
        parent::__construct();
    }

    public function add_application($application)
    {
        check_required_fields($application, MApplication::$REQUIRED_COLS);

        if (!array_key_exists("created_at", $application))
            $application["created_at"] = now();

        try{
            $this->db->insert('application', $application);
        }catch(Exception $e){
            throw MyException("Email yang anda masukkan sudah pernah melamar di jabatan tersebut, silahkan memilih jabatan yang lain.", 400);
        }

        $result = $this->db->affected_rows() > 0;

        if (!$result)
            throw MyException("Unable to add application", 500);

        return $this->db->insert_id();
    }
    public function fetch_applications(){
        $cols = implode(", a.", MApplication::$SAFE_COLS);
        $sql = "SELECT a.{$cols}, p.name AS position_name FROM application AS a, position AS p WHERE a.position=p.id;";
        $query = $this->db->query($sql);
        $results = $query->result_array();
        return $results;
    }
    public function check_email_position($email, $position){
        $sql = "SELECT TRUE FROM application a WHERE email=? AND position=?";
        $query = $this->db->query($sql, array($email, $position));
        $results = $query->result_array();
        if ($results)
            throw new MyException("Email yang anda masukkan sudah pernah melamar di jabatan tersebut, silahkan memilih jabatan yang lain.", 400);
    }
    public function delete_application($id)
    {
        $sql = "DELETE FROM application WHERE id=?";
        $query = $this->db->query($sql, array($id));
        $result = $this->db->affected_rows() > 0;

        if (!$result)
            throw new MyException("Application does not exist or already deleted", 400);
    }
}
?>
