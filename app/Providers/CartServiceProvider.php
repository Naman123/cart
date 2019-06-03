<?php
namespace App\Providers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;
use App\Models\TblFoodItems;
use App\Providers\BaseServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Config;


class CartServiceProvider extends BaseServiceProvider{
   public static function getSearchItems($search_txt) {
   	try {
    $client=new \GuzzleHttp\Client();
    $response = $client->get(Config::get('app.ndb_search_api'), [
    	'query' => [
        'format' => 'json',
        'max'=>10,
        'offset'=>0,
        'api_key'=>Config::get('app.ndb_api_key'),
        'q'=>$search_txt
    	],['allow_redirects' => false]
	 ]);
    $contents = json_decode((string) $response->getBody(), true); // returns all the contents
    return response()->json($contents);
    }
    catch (\Exception $e) {
            return static::responseException($e);
        }
 }
 //function to get Calorie per serve
 public static function getCaloriePerServe($itemId) {
    try {
    $client=new \GuzzleHttp\Client();
    $response = $client->get(Config::get('app.ndb_nutrient_api'), [
        'query' => [
        'format' => 'json',
        'max'=>Config::get('constants.MAX_REC_SEARCH'),
        'offset'=>0,
        'api_key'=>Config::get('app.ndb_api_key'),
        'nutrients'=>Config::get('constants.ENERGY_NUTRIENT_ID'),
        'ndbno'=>$itemId
        ],['allow_redirects' => false]
     ]);
    $contents = json_decode((string) $response->getBody(), true); // returns all
    //dd($contents);
    $calorieValue=$contents['report']['foods'][0]['nutrients'][0]['gm']; //per 100 g calories as per API
    $calorieValue=!empty($calorieValue)?$calorieValue:0;
    return $calorieValue;
    }
    catch (\Exception $e) {
            return static::responseException($e);
        }
  }

 //function to save item to cart
 public static function saveItem($request){
    try {
        $itemDetails=[];
        $caloriesPerServe=self::getCaloriePerServe($request['ndbno']);  
        $itemDetails['item_id'] = $request['ndbno'];
        $itemDetails['group_name'] = $request['group'];
        $itemDetails['name'] = $request['name'];        
        $itemDetails['added_on'] = time();       
        $itemDetails['status'] = 1;
        $itemDetails['calories'] = $caloriesPerServe;
        $insert_id=TblFoodItems::insertGetId($itemDetails); 
        if (empty($insert_id)) {
                return static::responseError("Item not added to Cart,Please try again.", [], Response::HTTP_NOT_FOUND);
            }
        return static::responseSuccess("success", TblFoodItems::count());
    }
    catch (\Exception $e) {
            return static::responseException($e);
        }
 }
 //get cart item count
 public static function getCartCount(){
    try{
        return ['cart_item_count'=>TblFoodItems::count()];
    }
    catch (\Exception $e) {
        dd($e->getMessage());
        return ['cart_item_count'=>0];

    }
 }
 //get calorie sum
 public static function getCartCalorieSum(){
    try{
        return TblFoodItems::sum('calories');
    }
    catch (\Exception $e) {
            return static::responseError("Not able to retrieve cart count,Please try again.", [], Response::HTTP_NOT_FOUND);
    }
 }
//get Cart Item List
 public static function getCartItemList($itemPerPage){
    try{
        return TblFoodItems::paginate($itemPerPage);
    }
    catch (\Exception $e) {
            return static::responseException($e);
        }
 }
}
?>