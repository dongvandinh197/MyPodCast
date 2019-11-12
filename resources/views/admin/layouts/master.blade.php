<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tóp Music - Admin's Site</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tóp music">
    <meta name="author" content="Đinh Văn Đông">
    <!-- Favicon icon -->
    @include('admin.layouts.inc.css')
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>

<div id="main-wrapper">

    @include('admin.layouts.inc.header')

    @include('admin.layouts.inc.aside')


    <div class="page-wrapper">

        @yield('content')

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
                <img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_1.jpg"
                     class="active" id="_1">
                <img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_2.jpg" id="_2">
                <img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_3.jpg" id="_3">
                <img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_4.jpg" id="_4">
                <img src="https://raw.githubusercontent.com/himalayasingh/music-player-1/master/img/_5.jpg" id="_5">
                <div id="buffer-box">Buffering ...</div>
            </div>
            <div id="player-controls">
                <div class="control">
                    <div class="button" id="play-previous">
                        <i class="fas fa-backward"></i>
                    </div>
                </div>
                <div class="control">
                    <div class="button" id="play-pause-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <div class="control">
                    <div class="button" id="play-next">
                        <i class="fas fa-forward"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.layouts.inc.js')
<script>
    {{--$(function () {--}}
        {{--$.ajax({--}}
            {{--type: 'GET',--}}
            {{--url: '{{route('mission.delete')}}',--}}
            {{--data: {id: id},--}}
            {{--success: function (data) {--}}
                {{--var rs = data;--}}
                {{--if (rs.status === 1) {--}}
                    {{--window.location.reload();--}}
                {{--} else {--}}
                    {{--bootbox.alert('Xóa thất bại.');--}}
                {{--}--}}
            {{--}--}}
        {{--});--}}
    {{--})--}}
</script>

<script>

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
        albums = ['Dawn', 'Me & You', 'Electro Boy', 'Home', 'Proxy (Original Mix)'],
        trackNames = ['Skylike - Dawn', 'Alex Skrindo - Me & You', 'Kaaze - Electro Boy', 'Jordan Schor - Home', 'Martin Garrix - Proxy'],
        albumArtworks = ['_1', '_2', '_3', '_4', '_5'],
        trackUrl = ['{{asset('storage/upload/files/audio/20191111_5dc91f030ced9.nuoc_mat_lau_bang_tinh_yeu_moi.mp3')}}', 'https://raw.githubusercontent.com/himalayasingh/music-player-1/master/music/1.mp3', 'https://raw.githubusercontent.com/himalayasingh/music-player-1/master/music/3.mp3', 'https://raw.githubusercontent.com/himalayasingh/music-player-1/master/music/4.mp3', 'https://raw.githubusercontent.com/himalayasingh/music-player-1/master/music/5.mp3'],
        playPreviousTrackButton = $('#play-previous'), playNextTrackButton = $('#play-next'), currIndex = -1;
    
</script>
@yield('js')


</body>

</html>