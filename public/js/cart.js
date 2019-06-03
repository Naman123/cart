SearchItem = new function() {
	var $instance = this;
  $instance.data={};
  $instance.domHandles ={
      'searchBox':'#search_item',
      'searchList':'#search_list',
      'cartHandle':'.shopping-cart' 	
    };
    $instance.init=function(){
    };

   $instance.searchItems = delayKeyup(function(event) {
  var searchStr=event.target.value;  
  var id=event.target.id;
  var code = event.which || event.keyCode;
  var excludeKeys = [9, 38, 40, 13];
  $("#search_item").addClass('loading');
  if(excludeKeys.indexOf(code) == -1) {
  if (searchStr.length > 0 ) {
    	var ajaxRoute='/item/search';
    	var data={"searchStr":searchStr,"_token":$('#_token').val()}      
    	$instance.fetchAjax(ajaxRoute,data).then(function(response){
      $($instance.domHandles.searchBox).removeClass('loading');
      if(response.errors){
          var errorRespose=response.errors.error[0].message;
          $($instance.domHandles.searchList).html('<span class="cart_count">'+errorRespose+'</span>').show();
      }
      else{
      var isValidData=typeof(response.list.item)!='undefined' && response.list.item.length>0;
        if(isValidData){
          $instance.populateSearchResults(response);
        }
      }
      });

  }
  else{
    $($instance.domHandles.searchList).html('').hide();
     $($instance.domHandles.searchBox).removeClass('loading');
   }
  }
}, 500);
    $instance.fetchAjax= _fetch();

  $instance.populateSearchResults=function(response){
    var dataObj=response.list.item;
    $instance.data=dataObj;
    var listHtml='';
    $(dataObj).each(function(i,v){
       var productName=$.trim(v['name']);
       var ndbno=$.trim(v['ndbno']);
        listHtml+='<li><div class="row"><div class="col-sm-9">'+productName+'&nbsp;</div><div class="col-sm-3"><span><a data-item-id="'+ndbno+'" class="btn btn-primary add_to_cart" onclick="SearchItem.addItemToCart(event)">Add to cart</a></span></div></div></li>';
     }); 
    $($instance.domHandles.searchList).html(listHtml).show();
  }


  $instance.addItemToCart=function(event){
    var itemSelector=$(event.target);
    var itemId =itemSelector.data('item-id');
    itemSelector.addClass('disabled').addClass('process');
    itemSelector.text('Adding.....');
    var itemDetails = $instance.data.filter(obj => {
      return parseInt(obj.ndbno)=== parseInt(itemId)
    });
    itemDetails=itemDetails[0];
      var ajaxRoute='/item/save';
      var data={"item":itemDetails,"_token":$('#_token').val()}      
      $instance.fetchAjax(ajaxRoute,data).then(function(response){
          itemSelector.removeClass('disabled').removeClass('process');
          itemSelector.text('Add to cart');
          $($instance.domHandles.cartHandle).effect("pulsate"); //animating cart

          if(response.status_code==200){
            var cart_item_count=response.result;
            $(".cart_count").text(cart_item_count);
          }
      })
  }

}
