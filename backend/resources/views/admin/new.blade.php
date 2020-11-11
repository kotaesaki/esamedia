@extends('admin.common')

@section('content')

<div class="container">
<div class="row justify-content-center">
<div class="justify-content-center col-md-8 col-md-offset-2 bg-white">
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
    <form method="post" action="{{ route('new_post') }}" enctype="multipart/form-data">
        @csrf
        

        <div id="file-preview" class="file-preview">
            <div class="form-group">
            <label class="form-label image-label" for="image" style="padding:5%;">
            <div class="add-image-btn">
            <img class="add-image" src="{{ asset('image/add-picture.png') }}">
            </div>
            <input id="image" class="form-input image-btn" type="file" name="image" accept="image/png, image/jpeg" v-on:change="onFileChange">
            </label>
            </div>
            <img class="userInfo__icon" v-bind:src="imageData" v-if="imageData">
        </div>

        <div class="form-group">
            <input type="text" name="post_title" placeholder="記事タイトル" style="border-width:0px;border-style:None; 
font-size: 35px; font-weight:bold; width: 90%;">
        </div>
        <div class="form-group">
            <div class="FlexTextarea">
            <div class="FlexTextarea__dummy" aria-hidden="true"></div>
            <textarea id="FlexTextarea" name="post_content" class="FlexTextarea__textarea" placeholder="コンテンツを入力してください"></textarea>
            </div>
            
        </div>
        <div class="form-group">
        <button type="submit">公開する</button>
        </div>

    </form>
    <div class="form-group">
    <button type="submit">下書き保存</button>
    </div>


    

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    new Vue({
        el: '#file-preview',
        data: {
            imageData: '' //画像格納用変数
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

</script>

</div>
</div>
</div>

@endsection
