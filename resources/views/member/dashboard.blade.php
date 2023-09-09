
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
        <h3>會員錢包資訊</h3>
        <p>/account</p>
        <!-- {{ $account }} -->
        <table border="1">
            <thead>
                <tr class="text-nowrap">
                    <td>用戶 ID</td>
                    <td>帳號</td>
                    <td>存款餘額</td>
                    <td>詳細資料</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="">{{ $account->user_id }}</td>
                    <td>{{ $account->account }}</td>
                    <td>{{ $account->deposit }}</td>
                    <td>{{ $account->infomation }}</td>
                </tr>
            </tbody>
        </table>
    <hr>

        <h3>會員錢包 - 存/提款功能</h3>
        <div>
            <input id="moneySave" type="number" name="amount" placeholder="存入金額" value="500">
            <button onclick="save()" >送出</button>
        </div>

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

    function save() {

        const moneySave = parseInt($('#moneySave').val());

        if (moneySave < 1) {
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
            url: `/account/save`,
            data: JSON.stringify({
                amount: moneySave
            })
        })
        .done(function( resp ) {
            console.log(resp);
            window.location.reload();

        });

    }
</script>