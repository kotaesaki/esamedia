@extends('admin.common')

@section('content')
<div class="container confirm">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-2 bg-white">
            <h2>ユーザーの削除</h2>
            <p>このユーザーを削除しようとしています。</p>
            <p>ログインID：{{ $thisUser->login_id }}</p>
            <p>名前：{{ $thisUser->name }}</p>
            <form action="{{ route('delete_user')}}" method="POST">
                @csrf
                <input type="hidden" value="{{ $thisUser->id}}" name="id">
                <input type="radio" name="delete" value="delete">全てのコンテンツを削除します。<br>
                <input type="radio" name="delete" value="not_delete" checked>全てのコンテンツを以下のユーザーのものにする。
                <select name="username">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select><br>
                <input type="submit" name="submit" value="実行する">
            </form>
        </div>
    </div>
</div>
@endsection