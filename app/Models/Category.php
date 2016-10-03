<?php

namespace App\Models;

use DebugBar;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $guarded = ['click'];


    public static function getTreeList(){
        $rows = self::orderBy("order","asc")->get();
        $result = self::getTree($rows);
        return $result;
    }

    public static function getTree($rows,$parent_id=0,$deep=0){
        static $result = [];
        foreach($rows as $row){
            if($row->parent_id==$parent_id){
                $row->name_text = str_repeat('&nbsp;',$deep*5).($deep==0?'':'┗').$row->name;
                $result[] = $row;
                self::getTree($rows,$row['id'],$deep+1);
            }
        }
        return $result;
    }
}
