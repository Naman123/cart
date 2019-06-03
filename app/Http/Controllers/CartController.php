<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller as Controller;
use App\Providers\CartServiceProvider;
use Illuminate\Http\Request;
use Config;
use Response;



class CartController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function searchItem(Request $request)
    {
    	$search_txt=$request->get('searchStr');
		return $response = CartServiceProvider::getSearchItems($search_txt);
    }
    public function saveItem(Request $request)
    {
       return CartServiceProvider::saveItem($request['item']);
     }    
      public function cartLanding(Request $request)
    {
        $data=CartServiceProvider::getCartCount();
        return view('cart',$data);

     }    
 public function cartItemtList(Request $request){
    $calorieSum=CartServiceProvider::getCartCalorieSum();
    $items= CartServiceProvider::getCartItemList(Config::get('constants.ITEM_PER_PAGE'));
    return view('listing',compact('items','calorieSum'))->with('i', ($request->input('page', 1) - 1) * Config::get('constants.ITEM_PER_PAGE'));
 }    
    
}
