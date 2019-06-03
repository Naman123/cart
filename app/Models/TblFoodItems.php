<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TblFoodItems extends Model
{    
    protected $table = "tbl_food_items";
    public $timestamps = false;
    protected $primaryKey = "id";
    
}
