<html>
    <head>
        <title>@if(!empty($full_address)){{$full_address}} @else No record found @endif</title>          
	<meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css" />
        <link href="{{asset('assets/css/custom.css?v=3.4.2')}}" rel="stylesheet"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link rel="stylesheet" href="{{asset('includes/css/mystyle.css')}}"> 
        <link rel="stylesheet" href="{{asset('assets/bootstrap-4.5.3-dist/css/bootstrap.min.css')}}"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
        <script src="{{asset('assets/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/js/custom.js')}}"></script>
        <script src="https://kit.fontawesome.com/c2af6e26fd.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css'>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
        <!-- <link rel="stylesheet" href="assets/css/coursal_style.css"> -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;1,900&display=swap"
        rel="stylesheet">
        <!-- <link rel="stylesheet" href="assets/css/coursal_style.css"> -->
        @yield('styles')
           
    </head>
    <body>
   


        <div class="container">
		<br><br>
		<div class="alert-w" role="alert">
  		</div>
            @yield('content')
            
        </div>
    <!-- <script src="assets/js/record.js"></script> -->
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js" defer></script>-->
     <script type="text/javascript" src="{{asset('assets/js/libpannellum.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pannellum.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js'></script>
    <script  src="{{asset('assets/js/coursal_script.js')}}"></script>
    <script  src="{{asset('assets/js/select.js')}}"></script>
    
    <script src="{{asset('assets/js/record.js')}}"></script>
    <script src="{{asset('assets/js/getallimage.js')}}"></script>
    <script src="{{asset('assets/js/deleteaudio.js')}}"></script>
    <script src="{{asset('assets/js/imagesevent.js')}}"></script>
    <script src="{{asset('assets/js/hotspot.js')}}"></script>
    <script src="{{asset('assets/js/deleteimage.js')}}"></script>
    <script src="{{asset('assets/js/sortable.js')}}"></script>
    <script src="{{asset('assets/js/rename.js')}}"></script>
    <script src="{{asset('assets/js/music.js')}}"></script>
    <script src="{{asset('assets/js/vrview.js')}}"></script>
    
    @yield('scripts')

    </body>
</html>