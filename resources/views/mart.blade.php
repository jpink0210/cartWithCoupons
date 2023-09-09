
@extends('layouts.head')

@section('content')
<div>
    <a href="/">回首頁</a>
    <h1>SignUp Page</h1>
    <p>提示：email不得重複</p>
    <div>
        <input id="s1" type="text" name="name" placeholder="姓名" value="王小明">
        <input id="s2" type="text" name="email" placeholder="email" value="user01@gmail.com">
        <input id="s3" type="password" name="password" placeholder="password" value="123456">
        <input id="s4" type="password" name="password_confirmation" placeholder="password" value="123456">

        <button onclick="submit()" class="btn btn-lg btn-success">註冊</button>

    </div>
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