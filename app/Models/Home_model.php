<?php
namespace App\Models;
use CodeIgniter\Model;
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends Model {

    public function _construct() {
        parent::__construct();
    }
    public function insert_batch($data){
        $this->db->insert_batch('posts',$data);
        if($this->db->affected_rows()>0)
        {
            return 1;
        }
        else{
            return 0;
        }
    }

}