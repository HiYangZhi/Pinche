<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
    <title>核电便民拼车</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="overtrue,bootstrap, bootstrap theme" />
    <meta name="description" content="a bootstrap theme made by overtrue." />

    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('vendor/pinche/vendor/datepicker/css/foundation-datepicker.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('vendor/pinche/css/mobile.css') }}" >
    <script src="//cdn.bootcss.com/jquery/1.12.4/jquery.js"></script>
    <script src="{{ asset('vendor/pinche/js/jquery.SuperSlide.2.1.1.js') }}"></script>

    @yield('css')
</head>
<body>
    
    @yield('content')

    
    <script src="https://cdn.bootcss.com/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script type="text/javascript" src=" {{ asset('vendor/pinche/vendor/datepicker/js/foundation-datepicker.min.js') }} "></script>
    <script type="text/javascript" src=" {{ asset('vendor/pinche/vendor/datepicker/js/locales/foundation-datepicker.zh-CN.js') }} "></script>
    @yield('js')
</body>
</html>