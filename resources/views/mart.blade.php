
@extends('layouts.head')

@section('content')
<div>
<a href="/">回首頁</a>
<a href="/member/dashboard">回會員中心</a>

    <table class="table" style="margin-top:30px;">
    <thead>
        <tr class="text-nowrap">
        <td>標題</td>
        <td>內容</td>
        <td>價格</td>
        <td>數量</td>
        <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach( $products as $product )
        <tr>
            <td class="">{{ $product->title }}</td>
            <td>{{ $product->content }}</td>
            <td style="{{ $product->price < 300 ? 'color:red; font-size:22px' : ''  }}" >{{ $product->price }}</td>
            <td>
            <div>{{ $product->quantity }} </div>
            </td>
            <td>
            @auth
                <button class="btn btn-warning" onclick="addToCart({{ $product->id }}, 1)">加入購物車</button>
            @else
                <input class="btn btn-warning" data-toggle="modal" data-target="#loginNotYet" type="button" value="加入購物車">
            @endauth
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
@endsection

<script>

function addToCart(product_id, quantity) {
    // https://laravel.com/docs/10.x/csrf#csrf-x-csrf-token

    const jwtToken = $.cookie("jwt");
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        "Content-Type": "application/json",
        Authorization: `Bearer ${jwtToken}`
      },
      method: "Post",
      url: `/cart_items`,
      data: JSON.stringify({
        cart_id: JSON.parse( `<?php echo $cart_id; ?>` ),
        product_id: product_id,
        quantity: quantity
      })
    })
    .done(function( resp ) {
      console.log(resp);
      var name = `${resp.name.slice(0, 9)}${resp.name.length > 10 ? '...' : ''}`;
      toastr.success( "新增成功 - " + name);

    });
  }


</script>