@extends('front.layout.layout')


@section('content')

<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{route('home')}}">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small>3 Item(s) </small>]<a href="{{route('home')}}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>		
			
	<table class="table table-bordered">
    <thead>
      <tr>
        <th>Product</th>
        <th>Name</th>
        <th>Quantity/Update</th>
				<th>Select</th>
				<th>Price</th>
			</tr>
    </thead>
      <tbody>

      	@php $sum = 0;  @endphp
      	@foreach($carts as $cart)
      	@php $sum = $sum + $cart->product->price;  @endphp
        <tr>
          <td> <img width="60" src="{{asset('uploads/'.$cart->product->image)}}" alt=""/></td>
          <td>{{$cart->product->name}}</td>
				  <td>
						<div class="input-append">
              
							<input class="span1" style="max-width:34px" placeholder="1" id="appendedInputButtons" size="16" value="{{$cart->qty}}" type="number">
							<button class="btn" type="button" id="btn_minus"><i class="icon-minus"></i></button>
							<button class="btn" type="button" id="btn_add"><i class="icon-plus"></i></button>
							<button class="btn btn-danger btn_close" data-id="{{$cart->id}}" type="button"><i class="icon-remove icon-white"></i></button></div>
				  </td>
          <td><input type="checkbox" name="select_product[]" cart-id="{{$cart->id}}" value="" id="product_price"></td>
          <td id="product_price_var">${{$cart->product->price}}</td>
        </tr>
				@endforeach
        <tr>
          <td colspan="4" style="text-align:right">Total Price:	</td>
          <td id="product_price_var_total"> ${{$sum}}</td>
        </tr>
				 <tr>
            <td colspan="3" style="text-align:right"></td>
            <td>Pay with eway<input type="checkbox" name="eway" style="margin-left: 12px;"></td>
            <td class="label label-important buy_product" style="display:block;cursor:pointer;"> <strong>Buy</strong></td>
          </tr>
			</tbody>
    </table>
			
	<a href="{{route('home')}}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
	<a href="{{route('user_login')}}" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
	
</div>

@endsection

@push('footer-script')

<script type="text/javascript">
  
$('.btn_close').on('click',function(){
  if (confirm('Are you sure to remove this product.')) {
    let id = $(this).data('id');

    $.ajax({

        url:'{{route("cart.delete")}}',
        data:{'id' : id},

        success:function(data){
          location.reload();
        }
    });
  }
});


</script>

<script type="text/javascript">
  let i = 0;
  let appendedInputButtons = document.getElementById('appendedInputButtons');
  let product_price_var = document.getElementById('product_price_var');
  var product_price = document.getElementById('product_price');
  let product_price_var_total = document.getElementById('product_price_var_total');
  $('#btn_add').on('click',function(){
    i += 1;
  appendedInputButtons.value = i;
    appendedInputButtons.innerHTML = i;
    product_price_var.innerHTML  =  "$" +'@php echo (count($carts)>0) ?  $cart->product->price :  '<script>alert("your Item is empty")</script>';  @endphp' * i;
    product_price_var_total.innerHTML = "$" + '@php echo $sum @endphp' * i;
  });


$('#btn_minus').on('click',function(){
  if (i > 0) {
  i -= 1;
}
    appendedInputButtons.value = i;
    appendedInputButtons.innerHTML = i;
    product_price_var.innerHTML  =  "$" +'@php echo (count($carts)>0)   ?  $cart->product->price :  '<script>alert("your Item is empty")</script>';  @endphp' * i;
    product_price_var_total.innerHTML = "$" + '@php echo $sum @endphp' * i;
 
})

</script>

<!-- buy products -->
<script type="text/javascript">

/*  check or uncheck*/
  product_price.addEventListener('change',function(event){
      if (event.currentTarget.checked) {
        alert('checked');
      }
      else{
        alert('unchecked');
      }
    });

  $('.buy_product').on('click',function(){
    let cart_id = [];
    let payment_type = '';

    if ($('input[name="eway"]').is(':checked')) {
      payment_type = 'eway';
    }else{
      payment_type = 'pay_person'
    }

  $('#product_price:checked').each(function(i){
    cart_id[i] = $(this).attr('cart-id');
    console.log(cart_id);
   
  });

  if (cart_id.length == 0){
    alert('Please select atleast one product.');
  }else{
    let formdata = new FormData();
    formdata.append('cart_id',cart_id);
    formdata.append('payment_type',payment_type);
    formdata.append('price',product_price_var_total.innerHTML);
    formdata.append('_token','{{csrf_token()}}');
    // alert(formdata.get('_token'));return;
   $.ajax({
      url:"{{route('product.booking')}}",
      type:"post",
      dataType:"json",
      data: formdata,
      contentType : false, 
      processData:false,
      cache: false,
      
    success:function(data){
      console.log('hi');
    }
   })
    
  }
    
      });
  
    
</script>
<script type="text/javascript">

  $('#appendedInputButtons').on('change',function(){
   
    product_price_var.innerHTML  =  "$" +'@php echo (count($carts)>0)  ?  $cart->product->price : '<script>alert("your Item is empty")</script>' ;  @endphp' * appendedInputButtons.value;
    product_price_var_total.innerHTML = "$" + '@php echo $sum @endphp' * appendedInputButtons.value;

  });
</script>

@endpush