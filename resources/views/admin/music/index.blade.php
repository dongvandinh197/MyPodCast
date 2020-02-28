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
                            <div class="el-card-avatar el-overlay-1" style="height: 200px;object-fit: cover">
                                <img src="{{asset($item->image)}}" alt="ảnh"/>
                                <div class="el-overlay">
                                    <ul class="list-style-none el-info">
                                        <li class="el-item">
                                            <a class="btn default btn-outline image-popup-vertical-fit el-link"
                                               href="{{route('music.edit',$item->id)}}">
                                                <i class="mdi mdi-tooltip-edit"></i>
                                            </a>
                                        </li>
                                        <li class="el-item">
                                            <a class="btn default btn-outline el-link" href="{{route('music.listen',$item->id)}}">
                                                <i class="mdi mdi-play"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="el-card-content">
                                <p class="m-b-0 limit-text" style="font-weight: 700;margin: 5px 0;">{{$item->name}}</p>
                                <span class="text-muted">{{$item->single}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

    </div>


    <div id="app-cover">
        <div id="player">
            <div id="player-track">
                <div id="album-name"></div>
                <div id="track-name"></div>
                <div id="track-time">
                    <div id="current-time"></div>
                    <div id="track-length"></div>
                </div>
                <div id="s-area">
                    <div id="ins-time"></div>
                    <div id="s-hover"></div>
                    <div id="seek-bar"></div>
                </div>
            </div>
            <div id="player-content">
                <div id="album-art">
                    @foreach($image as $img)
                        <img src="{{$img}}"
                             class="active" id="{{'_'.$loop->iteration}}">
                    @endforeach
                    {{--<img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_1.jpg"--}}
                         {{--class="active" id="_1">--}}
                    {{--<img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_2.jpg" id="_2">--}}
                    {{--<img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_3.jpg" id="_3">--}}
                    {{--<img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_4.jpg" id="_4">--}}
                    {{--<img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_5.jpg" id="_5">--}}
                    <div id="buffer-box">Buffering ...</div>
                </div>
                <div id="player-controls">
                    <div class="control">
                        <div class="button" id="play-next">
                            <i class="fas fa-forward"></i>
                        </div>
                    </div>


                    <div class="control">
                        <div class="button" id="play-pause-button">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                    <div class="control">
                        <div class="button" id="play-previous">
                            <i class="fas fa-backward"></i>
                        </div>
                    </div>
                    <div class="control">
                        <div class="button" id="play-muted">
                            <i class="fas fa-volume-up"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="audio" value="{{json_encode($audio)}}"/>
    <input type="hidden" id="name" value="{{json_encode($name)}}"/>
    <input type="hidden" id="single" value="{{json_encode($single)}}"/>
    <input type="hidden" id="image" value="{{json_encode($image)}}"/>

@endsection



@section('js-audio')
    <script>
        $(function () {
            $('#app-cover').css('display','none');
        })
    </script>

    <script>

        var audio = JSON.parse($('#audio').val());
        var image = JSON.parse($('#image').val());
        var audios = [];
        var albumAtWorks = [];
        audio.forEach(audio => {
            audios.push(audio);
        });
        image.forEach((image,index) => {
            albumAtWorks.push('_' + (index+1).toString());
        });
        var playerTrack = $("#player-track"),
            bgArtwork = $('#bg-artwork'),
            bgArtworkUrl,
            albumName = $('#album-name'),
            trackName = $('#track-name'),
            albumArt = $('#album-art'),
            sArea = $('#s-area'),
            seekBar = $('#seek-bar'),
            trackTime = $('#track-time'),
            insTime = $('#ins-time'),
            sHover = $('#s-hover'),
            playPauseButton = $("#play-pause-button"),
            i = playPauseButton.find('i'),
            tProgress = $('#current-time'),
            tTime = $('#track-length'),
            seekT, seekLoc, seekBarPos, cM, ctMinutes, ctSeconds, curMinutes, curSeconds,
            durMinutes, durSeconds, playProgress, bTime, nTime = 0, buffInterval = null,
            tFlag = false,
            albums = JSON.parse($('#name').val()),
            trackNames = JSON.parse($('#single').val()),
            albumArtworks = albumAtWorks,
            trackUrl = audios,
            playPreviousTrackButton = $('#play-previous'),
            playNextTrackButton = $('#play-next'),
            currIndex = -1,
            playMutedButton = $('#play-muted'),
            iMuted = playMutedButton.find('i')

        ;

    </script>
@endsection