<html>
    <head>
        <title>Shopping Cart - @yield('title')</title>
             <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
             <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.theme.css') }}">
             <link rel="stylesheet" href="{{ URL::asset('css/cart.css') }}">
             <script src="{{ URL::asset('js/jquery.js') }}"></script>
             <script src="{{ URL::asset('js/jquery_ui.js') }}"></script>
             @yield('template_css')
             <script type="text/javascript" src="{{ URL::asset('js/common.js') }}"></script>
              @yield('template_js')
                  <script type="text/javascript">
                    var APP_URL = "{{ Config::get('app.url')}}"
                    </script>

    </head>
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ URL::to('/')}}">Food Cart</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="{{ Request::segment(1) === null ? 'active' : null }}"><a href="{{ URL::to('/')}}">Search</a></li>
      <li class="{{ Request::segment(1) === 'list' ? 'active' : null }}"><a href="{{ URL::to('/')}}/list">Cart</a></li>
    </ul>
  </div>
</nav>
    <body>
        <div id="container">
            @yield('content')
        </div>
         
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>


    </body>
</html>
