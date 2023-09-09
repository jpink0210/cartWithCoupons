
@extends('layouts.head')

@section('content')
<div>
    測試專用：
    <button class="btn btn-warning" onclick="getData()">取得 balance</button>

    <hr>
    <h3>會員錢包 - 轉帳資訊 (最近 20 筆)</h3>
    <table border="1">
        <thead>
            <tr class="text-nowrap">
                <td>用戶 ID</td>
                <td>帳號</td>
                <td>存款餘額</td>
            </tr>
        </thead>
        <tbody>
            @foreach( $balances as $balance )

                <tr>
                    <td class="">{{ $balance->trade_amount }}</td>
                    <td>{{ $balance->deposit }}</td>
                    <td>{{ $balance->updated_at }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

        

</div>
@endsection

<script>

    function getData() {
        const jwtToken = $.cookie("jwt");

        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Content-Type": "application/json",
                    Authorization: `Bearer ${jwtToken}`
                },
                method: "get",
                url: `/api/balance`
            })
            .done(function( resp ) {
                console.log(resp);
            });
    }

</script>