 
<!DOCTYPE html>
<html>
    <head>
        <title>Imrul Kais</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="{{asset('dist/images/favicon.png')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('dist/css/custom.css')}}">
        <script src="{{asset('dist/js/angular.js')}}" type="text/javascript"></script>
        <script src = "{{asset('bootstrap/js/jquery.min.js')}}" type="text/javascript"></script>
        <script src = "{{asset('bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
   </head>
    <body>
        <!--login modal-->
        <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="text-center">Login</h1>
                    </div>
                    <div class="modal-body">
                        <form class="form col-md-12 center-block" method="post" action="{{ url('dologin') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <input type="text" class="form-control input-lg" placeholder="Email" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control input-lg" placeholder="Password" name="password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg btn-block">Sign In</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12">
                        </div>	
                    </div>
                </div>
            </div>
        </div>
        </body>
</html>