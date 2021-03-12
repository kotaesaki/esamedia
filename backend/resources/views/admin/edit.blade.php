@extends('admin.common')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="justify-content-center col-md-11 col-md-offset-2">
            <div>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @foreach($posts as $post)
                <form method="post" action="{{ route('edit_post') }}" enctype="multipart/form-data">
                    @csrf
                    <div id="file-preview" class="file-preview">
                        <div class="form-group">
                            <label class="form-label image-label" for="image" style="padding:5%;">
                                <div class="add-image-btn">
                                    <img class="add-image" src="{{ asset('image/add-picture.png') }}">
                                </div>
                                <input id="image" class="form-input image-btn" type="file" name="image"
                                    accept="image/png, image/jpeg" v-on:change="onFileChange">
                            </label>
                        </div>
                        <img class="userInfo__icon" v-bind:src="imageData" v-if="imageData">
                    </div>

                    <div class="form-group">
                        <div class="FlexTexttitle">
                            <div class="FlexTexttitle__dummy" aria-hidden="true"></div>
                            <textarea id="FlexTexttitle" name="post_title" class="FlexTextarea__title"
                                placeholder="記事タイトル">{{ $post->post_title }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="FlexTextarea">
                            <div class="FlexTextarea__dummy" aria-hidden="true"></div>
                            <textarea id="FlexTextarea" name="post_content" class="FlexTextarea__textarea"
                                placeholder="コンテンツを入力してください">{{ $post->post_content }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-md-offset-2 justify-content-center bg-white mt-5">
                            <div class="form-group">
                                <label for="category">カテゴリー</label>
                                <ul class="category_list">
                                    @foreach($terms_parent as $term_parent)
                                    <li><input type="checkbox" name="category[]"
                                            value="{{ $term_parent->term_id}}">{{ $term_parent->term_name}}</li>
                                    <ul>
                                        @foreach($terms_child as $term_child)
                                        @if($term_parent->term_id == $term_child->parent)
                                        <li><input type="checkbox" name="category[]"
                                                value="{{ $term_child->term_id}}">{{ $term_child->term_name}}
                                        </li>
                                        <ul>
                                            @foreach($terms_child as $term_childd)
                                            @if($term_child->term_id == $term_childd->parent)
                                            <li><input type="checkbox" name="category[]"
                                                    value="{{ $term_childd->term_id}}">{{ $term_childd->term_name}}
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                        @endif
                                        @endforeach
                                    </ul>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-2 justify-content-center bg-white ml-5 mt-5">
                            <div class="form-group">
                                <label for="tag">タグ</label><br>
                                @foreach($terms_tag as $term_tag)
                                <input type="checkbox" name="tags[]" id="tag"
                                    value="{{$term_tag->term_id}}">{{$term_tag->term_name}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="post_excerpt">
                            <label for="post_excerpt">抜粋</label>
                            <textarea name="post_excerpt" id="post_excerpt"
                                placeholder="TOPページに載せたい文章を書いてください">{{ $post->post_excerpt}}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                    <div class="form-group">
                        <button type="submit" name="publish" value="publish" class="btn-square-pop">公開する</button>
                        <button type="submit" name="private" value="private" class="btn-square-shitagaki">下書き保存</button>
                    </div>

                </form>
                @endforeach



                <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
                <script>
                    new Vue({
        el: '#file-preview',
        data: {
            imageData: '{{ Storage::url($post->file_path) }}' //画像格納用変数
        },
        methods: {
            onFileChange(e) {
                const files = e.target.files;

                if(files.length > 0) {

                    const file = files[0];
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        this.imageData = e.target.result;

                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    });

    function flexTextarea(el) {
        const dummy = el.querySelector('.FlexTextarea__dummy')
        el.querySelector('.FlexTextarea__textarea').addEventListener('input', e => {
            dummy.textContent = e.target.value + '\u200b'
        })
    }
    document.querySelectorAll('.FlexTextarea').forEach(flexTextarea)

    function flexTexttitle(el) {
        const dummy = el.querySelector('.FlexTexttitle__dummy')
        el.querySelector('.FlexTextarea__title').addEventListener('input', e => {
            dummy.textContent = e.target.value + '\u200b'
        })
    }
    document.querySelectorAll('.FlexTexttitle').forEach(flexTexttitle)
                </script>

            </div>
        </div>
    </div>

    @endsection