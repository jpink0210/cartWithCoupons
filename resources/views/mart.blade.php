
@extends('layouts.head')

@section('content')
<div>
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

    function submit() {

            $.ajax({
                method: "post",
                url: `/signup`,
                data: {
                    name: $('#s1').val(),
                    email: $('#s2').val(),
                    password: $('#s3').val(),
                    password_confirmation: $('#s4').val()
                }
            })
            .done(function( resp ) {
                console.log(resp);
                $.cookie("jwt", resp.token);

                window.location.assign('/member/dashboard')
            });
    }

</script>