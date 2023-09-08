
@extends('layouts.head')

@section('content')
<div>
    <h2>這是會員首頁 dashboard</h2>

    <button onclick="logout()" class="btn btn-lg btn-success">登出</button>

</div>
@endsection

<script>
    setTimeout(() => {
        
        const jwt = $.cookie("jwt");
        if (!jwt) {
            window.location.assign('/')
        }
    }, 1000);

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
                setTimeout(() => {
                    window.location.assign('/')

                }, 2000);
            });
    }
</script>