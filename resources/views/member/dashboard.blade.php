
@extends('layouts.head')

@section('content')
<div>
    <a href="/">回首頁</a>

    <div>
        <h2 style="float: left;">會員中心</h2>
    
        
    <button style="margin-left: 200px; margin-top: 20px;" onclick="logout()" class="btn btn-lg btn-success" >登出</button>

    </div>
    <div style="clear:both;"></div>
    <a href="/member/cart">查看購物車</a>
    <br>
    <hr>

</div>
@endsection

<script>

    function logout() {
        const jwtToken = $.cookie("jwt");

        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${jwtToken}`
                },
                method: "get",
                url: `/logout`
            })
            .done(function( resp ) {
                console.log(resp);
                $.cookie('jwt', '');
                setTimeout(() => {
                    window.location.assign('/')
                }, 2000);
            });
    }
</script>