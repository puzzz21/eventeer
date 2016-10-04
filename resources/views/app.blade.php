<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css"  href= "{{asset('css/mdb.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{asset('mdb.min.css')}}"/>
        <script src="{{asset('js/jquery-2.2.3.js')}}"> </script>
        <script src="{{asset('jquery-2.2.3.min.js')}}"></script>
        <script src="{{asset('js/mdb.js')}}"></script>
        <script src="{{asset('js/mdb.min.js')}}"></script>
        <script src="{{asset('js/tether.js')}}"></script>
        <script src="{{asset('js/tether.min.js')}}"></script>
        <style type="text/css">
            @font-face {
                font-family: Roboto-Regular;
                src: url('{{ public_path('fonts/roboto/Roboto-Regular.tff') }}');
            }
        </style>
    </head>
      <body>
          @yield('content')
      </body>
</html>