@extends('admin.common')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-2 bg-white">

            <div class="table-responsive">
                　　<table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ログインID</th>
                            <th>名前</th>
                            <th>メール</th>
                            <th>役割</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>ログインID</th>
                            <th>名前</th>
                            <th>メール</th>
                            <th>役割</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id}}</td>
                            <td>{{ $user->login_id}}</td>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->user_status}}</td>
                            <td>
                                <a id="navbarDropdown" class="align-middle" style="position: relative;color:#339bf7"
                                    href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    •••</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <form action="{{ route('confirm_user') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id}}">
                                        <input type="submit" name="delete" class="dropdown-item" value="削除"
                                            onclick='return confirm("このユーザーを削除しますか？");'>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    　　
                </table>
            </div>
        </div>
    </div>
</div>
@endsection