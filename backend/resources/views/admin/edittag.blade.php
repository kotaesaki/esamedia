@extends('admin.common')

@section('content')
<div class="container category">
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-2 bg-white">
            <p>タグを編集</p>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{route('update_tag')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name">名前</label>
                    <input type="text" name="name" id="name" class="category-textform" value="{{ $term->term_name}}">
                </div>
                <div class="form-group row">
                    <label for="slug">スラッグ</label>
                    <input type="text" name="slug" id="slug" class="category-textform" value="{{ $term->term_slug}}">
                </div>

                <div class="form-group row">
                    <label for="description">説明</label>
                    <textarea name="description" id="" cols="30" rows="10"
                        class="category-textform">{{ $term->term_description}}</textarea>
                </div>
                <div class="form-group row">
                    <input type="hidden" name="id" value="{{ $term->term_id}}">
                    <input type="submit" name="submit" id="submit" value="タグを更新">
                </div>

            </form>
        </div>
    </div>
</div>

@endsection