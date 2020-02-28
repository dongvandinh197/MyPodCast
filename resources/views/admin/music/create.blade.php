@extends('admin.layouts.master')


@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Thêm nhạc</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form action="{{!$item ? route('music.store') : route('music.update',$item->id)}}" method="post"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="card">
                <div class="card-body row">

                    <div class="col-md-3">
                        <div class="form-group row">
                            {{--<label class="col-md-3">Chọn ảnh</label>--}}
                            <div class="col-md-12 text-center">
                                <div class="custom-file">
                                    <input type="file" id="image" name="image" onchange="previewFile()" hidden>
                                    @if($item!= null)
                                        <img id="img" src="{{asset($item->image)}}" alt="Ảnh" width="150px"
                                             height="auto"
                                             style="cursor: pointer;"/>
                                    @else
                                        <img id="img" class="div_img" src="{{asset('images/none.png')}}" alt="Ảnh"
                                             width="150"
                                             height="auto"
                                             style="cursor: pointer;border: 1px dotted grey"/>
                                    @endif

                                    @if ( count($errors) > 0)
                                        <span style="color:red;display: block;margin-top: 10px;">{{$errors->first('image')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-9">
                        <div class="form-group row">
                            <label class="col-md-3" for="disabledTextInput">Tên bài hát: </label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="disabledTextInput" class="form-control"
                                       placeholder="Nhập tên bài hát"
                                       value="{{$item ? $item->name : (old('name') ? old('name') : '' )}}">
                            </div>
                        </div>
                        {{--lỗi tên --}}
                        @if ( count($errors) > 0)
                            <div class="form-group row">
                                <label class="col-md-3"></label>
                                <div class="col-md-9">
                                    <span style="color:red;display: block;margin-top: 10px;">{{$errors->first('name')}}</span>
                                </div>
                            </div>
                        @endif


                        <div class="form-group row">
                            <label class="col-md-3" for="disabledTextInput">Tên ca sĩ: </label>
                            <div class="col-md-9">
                                <input type="text" name="single" id="disabledTextInput" class="form-control"
                                       placeholder="Nhập tên ca sĩ"
                                       value="{{$item ? $item->single : (old('single') ? old('single') : '' )}}">
                            </div>
                        </div>
                        {{--lỗi tên  ca sĩ--}}
                        @if ( count($errors) > 0)
                            <div class="form-group row">
                                <label class="col-md-3"></label>
                                <div class="col-md-9">
                                    <span style="color:red;display: block;margin-top: 10px;">{{$errors->first('single')}}</span>
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label class="col-md-3" for="disabledTextInput">Mô tả: </label>
                            <div class="col-md-9">
                                <input type="text" name="desc" id="disabledTextInput" class="form-control"
                                       placeholder="Nhập mô tả"
                                       value="{{$item ? $item->desc : (old('desc') ? old('desc') : '' )}}">
                            </div>
                        </div>
                        @if($item == null)
                            <div class="form-group row">
                                <label class="col-md-3">Tải lên: </label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="music"
                                               id="validatedCustomFile" accept="audio/*">
                                        <label class="custom-file-label" for="validatedCustomFile">Chọn nhạc...</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <label class="col-md-3">Tải lên: </label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="music"
                                               id="validatedCustomFile"
                                               accept="audio/*">
                                        <label class="custom-file-label" for="validatedCustomFile">Sửa nhạc...</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{--lỗi nhạc--}}
                        @if ( count($errors) > 0)
                            <div class="form-group row">
                                <label class="col-md-3"></label>
                                <div class="col-md-9">
                                    <span style="color:red;display: block;margin-top: 10px;">{{$errors->first('music')}}</span>
                                </div>
                            </div>
                        @endif
                    </div>


                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('js')
    <script>
        $('#img').click(function () {
            $('#image').click();
        });

        function previewFile() {
            var preview = document.getElementById('img');
            var file = document.getElementById('image').files[0];

            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "{{$item ? $item->image : ''}}";
            }
        }


    </script>
@endsection