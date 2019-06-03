@extends('master')

@section('title')
Search Items
@stop

@section('template_css')
<link rel="stylesheet" href="{{ URL::asset('css/cart.css') }}">
@stop
@section('template_js')
    <script type="text/javascript" src="{{ URL::asset('js/cart.js') }}"></script>
       <script>
        $(document).ready(function(){
            SearchItem.init();
        });
</script>
@stop
@section('content')

   	 <div class="right"><span class='shopping-cart'><a href="{{ url('/') }}
/list" target="_blank"><strong class='cart_count'>{{ $cart_item_count }}</strong><img class='img' src="{{ URL::asset('images/shopping-cart.png') }}"></span></a></div>
        <form id="myForm">
        <div class="row">
            <div class='col-sm-3'>
            </div>
            <div class="col-sm-6">
<input type="text" autocomplete="off" onkeyup="SearchItem.searchItems(event)" placeholder="Enter your keyword to search e.g. Bread"  id="search_item" class="autosuggest form-control">
<div class="dropdown">
    <ul class="result" id="search_list">
      
    </ul>
</div>
</div>
<!--<div class="col-sm-3 right">
<a class='btn-primary btn search_cta'>Search Items</a>
        </div>-->
 <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    </div>
 </form>
@stop

</div>

