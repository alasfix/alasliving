<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Wishlist extends BaseController
{
    public function index()
    {
        echo"slug";
    }
    public function slug($slug)
    {
        $db = db_connect();
        $query = $db->query("select * from ta_wishlist where slug ='$slug'");
        $row = $query->getRow();
        $data['db'] = $db;
        if (isset($row)) {
            $data['deskripsi'] = $row->deskripsi;
            $data['id_wishlist'] = $row->id_wishlist;
            $dw = $data['id_wishlist'];
            $qw2 = $db->query("select * from ta_wishlist_sub1");
            $data['wishlist'] = $qw2->getResult();
            
        }
        else{
            $data['deskripsi'] = "Opsss... Link not work";
            $data['id_wishlist'] ="";
        }
        
        $data['slug'] = $slug ;
        return view('wishlist',$data);
    }
}
