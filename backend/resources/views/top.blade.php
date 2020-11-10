@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div style="background-color:white; width:80%; height: 300px;">
        
        </div>
        <div>
            contents
        </div>
        <div>
            ページネーション
        </div>
        </div>

        <div class="col-md-4">
        <aside>
        <span>Search</span>
        <form action="#" method="GET">
            <div class="form-group input-group">
                <input type="text">
                <span class="input-group-btn text-right">
                <button type="submit" class="btn btn-primary">検索</button>
                </span>
            </div>
        </form>
        </aside>

        <aside>
        <span>New</span>
        </aside>
        <aside>
        <span>Category</span>
        </aside>
        <aside>
        <span>About me</span>
        </aside>
        
        </div>
    </div>
</div>
@endsection