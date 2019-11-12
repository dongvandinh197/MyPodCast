@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <form action="{{route('music.index')}}" method="get" style="margin-bottom: 15px;" class="form-inline">
                        <div class="col-md-3 input-group ">
                            <input type="text" placeholder="Tìm kiếm..." name="keyword" aria-describedby="button-addon2"
                                   class="form-control" value="">
                            <div class="input-group-append">
                                <button id="button-addon2" type="submit" class="btn btn-primary">Tìm</button>
                            </div>
                        </div>
                        <div class="col-md-2 input-group select">
                            <select name="type" class="form-control custom-select" onchange="this.form.submit()">
                                {{--<option selected value="-1">Tất cả</option>--}}
                                {{--<option value="1" {{$type == 1? 'selected' : ''}}>Cố định</option>--}}
                                {{--<option value="2" {{$type == 2? 'selected' : ''}}>Duy trì</option>--}}
                                {{--<option value="3" {{$type == 3? 'selected' : ''}}>Giữ kỷ lục</option>--}}
                            </select>
                        </div>
                        <div class="col-md-7">
                            <a href="{{route('music.create')}}" class="btn btn-primary float-right">Thêm</a>
                        </div>

                    </form>
                </div>
            </div>
        <div class="row el-element-overlay">

            @foreach($data as $item)
                <div class="col-lg-2 col-md-3">
                    <div class="card">
                        <div class="el-card-item">
                            <div class="el-card-avatar el-overlay-1">
                                <img src="{{asset($item->image)}}" alt="ảnh"/>
                                <div class="el-overlay">
                                    <ul class="list-style-none el-info">
                                        <li class="el-item">
                                            <a class="btn default btn-outline image-popup-vertical-fit el-link" href="{{route('music.edit',$item->id)}}">
                                                <i class="mdi mdi-tooltip-edit"></i>
                                            </a>
                                        </li>
                                        <li class="el-item">
                                            <a class="btn default btn-outline el-link">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="el-card-content">
                                <p class="m-b-0 limit-text"  style="font-weight: 700;margin: 5px 0;">{{$item->name}}</p> <span class="text-muted">{{$item->single}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

    </div>
@endsection