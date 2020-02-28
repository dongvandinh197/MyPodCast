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

@yield('js-audio')
@yield('js')


</body>

</html>