
@extends('layouts.head')

@section('content')
<div>
    <a href="/">回首頁</a>
    <br>

    <h2>會員中心</h2>
    <a href="/member/dashboard">會員首頁</a>
    <br>
    <hr>
    
    <h2>會員中心 - 購物車</h2>
    總金額：

    <?php
      $total = 0;
      foreach ($cartItems as $cartItem) {
        $total += $cartItem->total;
      }
      echo $total;
    ?>

    <table class="table" style="margin-top:30px;border-collapse:collapse;" border="1">
        <thead>
            <tr class="text-nowrap">
            <td>標題</td>
            <td>單價</td>
            <td>數量</td>
            <td>優惠券 id</td>
            <td>折扣金額</td>
            <td>單品項總金額</td>
            <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach( $cartItems as $cartItem )
              <tr>
                  <td class="">{{ $cartItem->product->title }}</td>
                  <td >{{ $cartItem->price }}</td>
                  <td>{{ $cartItem->quantity }} </td>
                  <td>{{ $cartItem->mart_coupon_id ? $cartItem->mart_coupon_id : '尚未使用優惠券' }} </td>
                  <td>{{ $cartItem->discount_amount }} </td>
                  <td>{{ $cartItem->total }} </td>
                  <td>
                    <input id="changeQuans" type="number" placeholder="調整數量(>0)" value="">
                    <button class="btn btn-warning" onclick="changeNumber({{ $cartItem->id }})">修改數量</button>
                  </td>
                  
                  <td>
                    <button class="btn btn-warning" onclick="removeCoupon({{ $cartItem->id }})">取消優惠券</button>
                  </td>
                  <td>
                    ///
                  </td>
                  <td>
                    <button class="btn btn-warning" onclick="removeItem({{ $cartItem->id }})">刪除商品</button>
                  </td>
              </tr>
              @foreach( $martcoupons as $martcoupon )
                <tr>
                  
                  <td colspan="6">
                    {{$martcoupon->name}}
                  </td>
                  <td>
                    <button class="btn btn-warning" onclick="useCoupon({{ $martcoupon->id }}, {{ $cartItem->id }}, {{$cartItem->mart_coupon_id}})">使用優惠券</button>
                  </td>
                </tr>
              @endforeach
              
            @endforeach
        </tbody>
    </table>
</div>
@endsection

<script>

  function useCoupon(martCouponId, cartItemId, cartItemMartCoupon) {

    if (cartItemMartCoupon !== 0) {
      alert("已經有使用優惠券，請先取消原本的優惠券。");
      return;
    }

    const jwtToken = $.cookie("jwt");
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        "Content-Type": "application/json",
        Authorization: `Bearer ${jwtToken}`
      },
      method: "put",
      url: `/cart_items/mart_coupon/${cartItemId}`,
      data: JSON.stringify({
        id: cartItemId,
        martCouponId: martCouponId
      })
    })
    .done(function( resp ) {
      console.log(resp);

      window.location.reload();

    });

  }


  function removeCoupon(cartItemId) {
    const jwtToken = $.cookie("jwt");
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        "Content-Type": "application/json",
        Authorization: `Bearer ${jwtToken}`
      },
      method: "put",
      url: `/cart_items/mart_coupon/remove/${cartItemId}`
    })
    .done(function( resp ) {
      console.log(resp);

      window.location.reload();

    });
    
  }

  function removeItem(cartItemId) {

    const jwtToken = $.cookie("jwt");
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        "Content-Type": "application/json",
        Authorization: `Bearer ${jwtToken}`
      },
      method: "delete",
      url: `/cart_items/${cartItemId}`
    })
    .done(function( resp ) {
      console.log(resp);

      window.location.reload();

    });
    
  }
  function changeNumber(cartItemId) {

    const changeQuans = Math.floor(parseInt($('#changeQuans').val()));

    if (changeQuans < 1) {
     return;
    }
    const jwtToken = $.cookie("jwt");
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        "Content-Type": "application/json",
        Authorization: `Bearer ${jwtToken}`
      },
      method: "put",
      url: `/cart_items/${cartItemId}`,
      data: JSON.stringify({
        id: cartItemId,
        quantity: changeQuans
      })
    })
    .done(function( resp ) {
      console.log(resp);

      window.location.reload();

    });
  }

</script>