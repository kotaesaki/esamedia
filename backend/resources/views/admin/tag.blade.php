@extends('admin.common')

@section('content')
<div class="container category">
    <div class="row justify-content-center">
        <div class="col-md-4 col-md-offset-2 bg-white category-form">
            <p>新規タグを追加</p>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{route('create_tag')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name">名前</label>
                    <input type="text" name="name" id="name" class="category-textform">
                </div>
                <div class="form-group row">
                    <label for="slug">スラッグ</label>
                    <input type="text" name="slug" id="slug" class="category-textform">
                </div>

                <div class="form-group row">
                    <label for="description">説明</label>
                    <textarea name="description" id="" cols="30" rows="10" class="category-textform"></textarea>
                </div>
                <div class="form-group row">
                    <input type="submit" name="submit" id="submit" value="新規タグを追加">
                </div>

            </form>
        </div>
        <div class=" col-md-8 col-md-offset-2 bg-white">
            <div class="table-responsive category-table">
                　　<table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>説明</th>
                            <th>スラッグ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>名前</th>
                            <th>説明</th>
                            <th>スラッグ</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($terms as $term)
                        <tr>
                            <td>{{ $term->term_name}}</td>
                            <td>{{ $term->term_description}}</td>
                            <td>{{ $term->term_slug}}</td>
                            <td>
                                <a id="navbarDropdown" class="align-middle" style="position: relative;color:#339bf7"
                                    href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    •••</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <form action="{{ route('edit_tag',['term_id'=> $term->term_id])}}">
                                        @csrf
                                        <input type="submit" name="edit" value="編集" class="dropdown-item">
                                    </form>
                                    <form action="{{ route('delete_tag')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$term->term_id}}">
                                        <input type="submit" name="delete" class="dropdown-item" value="削除"
                                            onclick='return confirm("このタグを削除しますか？");'>
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