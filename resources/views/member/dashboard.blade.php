
@extends('layouts.head')

@section('content')
<div>
    <a href="/">回首頁</a>

    <h2>這是會員首頁 dashboard</h2>

    <button onclick="logout()" class="btn btn-lg btn-success">登出</button>
    <br>
    <br>
    <a href="/member/cart">查看購物車</a>

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