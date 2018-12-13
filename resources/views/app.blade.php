<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Action Items Project</title>
    <meta name="description" content="Action Items Project made by Paweł Walczykiewicz">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}"/>

    <script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
</head>

<body style="background: #464646;">
<div id="front_wrapper">
    <div class="container" style="padding-bottom: 60px;">
        @yield('content')
    </div>
</div>
</body>
</html>

@yield('scripts')


