<head>
	<meta charset="utf-8">
	<title>Property Management</title>
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/vendors/images/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/vendors/images/favicon-32x32.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/vendors/images/favicon-16x16.png')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/styles/core.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/styles/icon-font.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/src/plugins/datatables/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/styles/style.css')}}">
	{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ant-design-icons/4.7.0/index.css" /> --}}
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css" />
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	{{-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'> --}}
	{{-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css'> --}}
	<script src="https://kit.fontawesome.com/c2af6e26fd.js" crossorigin="anonymous"></script>
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet"/>
	<link rel="stylesheet" href="{{ asset('assets/css/active.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="base_url" content="{{ url('/') }}">
 <style>
  .toggle { border-radius: 20rem; }
  .closeicon{
      font-weight: 400 !important;
  }
  .switch {
  margin: 4rem auto;
}
/* main styles */
#draggable {
    border-radius: 0%;
    background-image: url(assets/images/drop2.png);
    width: 60px;
    height: 60px;
    background-size: 60px auto;
    background-position: 0px -60px;
}
.switch {
    width: 24rem;
    position: absolute;
    right: 51mm;
}
.switch input {
  position: absolute;
  top: 0;
  z-index: 2;
  opacity: 0;
  cursor: pointer;
}
.switch input:checked {
  z-index: 1;
}
.switch input:checked + label {
  opacity: 1;
  cursor: default;
}
.switch input:not(:checked) + label:hover {
  opacity: 0.5;
}
.switch label {
  color: #495057;
  opacity: 0.33;
  transition: opacity 0.25s ease;
  cursor: pointer;
}
.switch .toggle-outside {
  height: 100%;
  border-radius: 2rem;
  padding: 0.25rem;
  overflow: hidden;
  transition: 0.25s ease all;
}
.switch .toggle-inside {
    border-radius: 5rem;
    background: #61d03e;
    position: absolute;
    margin-top: -2px;
    transition: 0.25s ease all;
}

.switch--horizontal {
  margin: 0 auto;
  font-size: 0;
  margin-bottom: 1rem;
}
.switch--horizontal input {
  height: 3rem;
  width: 6rem;
  left: 6rem;
  margin: 0;
}
.switch--horizontal label {
  font-size: 1.5rem;
  line-height: 3rem;
  display: inline-block;
  width: 6rem;
  height: 100%;
  margin: 0;
  text-align: center;
}
.switch--horizontal label:last-of-type {
    margin-left: 4rem;
    margin-top: -10px;
}
.switch--horizontal .toggle-outside {
    position: absolute;
    width: 68px;
    left: 6rem;
    height: 2rem;
    border: 2px #a4a3b1 solid;
}
.switch--horizontal .toggle-inside {
  height: 1.5rem;
    width: 1.5rem;
}
.switch--horizontal input:checked ~ .toggle-outside .toggle-inside {
  left: 0.25rem;
}
.switch--horizontal input ~ input:checked ~ .toggle-outside .toggle-inside {
  left: 2.25rem;
}
.switch--vertical {
  width: 12rem;
  height: 6rem;
}
.switch--vertical input {
  height: 100%;
  width: 3rem;
  right: 0;
  margin: 0;
}
.switch--vertical label {
  font-size: 1.5rem;
  line-height: 3rem;
  display: block;
  width: 8rem;
  height: 50%;
  margin: 0;
  text-align: center;
}
.switch--vertical .toggle-outside {
  background: #fff;
  position: absolute;
  width: 3rem;
  height: 100%;
  right: 0;
  top: 0;
}
.switch--vertical .toggle-inside {
  height: 2.5rem;
  left: 0.25rem;
  top: 0.25rem;
  width: 2.5rem;
}
.switch--vertical input:checked ~ .toggle-outside .toggle-inside {
  top: 0.25rem;
}
.switch--vertical input ~ input:checked ~ .toggle-outside .toggle-inside {
  top: 3.25rem;
}
.switch--no-label label {
  width: 0;
  height: 0;
  visibility: hidden;
  overflow: hidden;
}
.switch--no-label input:checked ~ .toggle-outside .toggle-inside {
  background: rgba(0,0,0,0.2);
  border: 1px solid rgba(0,0,0,0.2);
}
.switch--no-label input ~ input:checked ~ .toggle-outside {
  background: #fff;
}
.switch--no-label input ~ input:checked ~ .toggle-outside .toggle-inside {
  background: #2ecc71;
}
.switch--no-label.switch--vertical {
  width: 3rem;
}
.switch--no-label.switch--horizontal {
  width: 6rem;
}
.switch--no-label.switch--horizontal input,
.switch--no-label.switch--horizontal .toggle-outside {
  left: 0;
}
.switch--expanding-inner input:checked + label:hover ~ .toggle-outside .toggle-inside {
  height: 2.5rem;
  width: 2.5rem;
}
.switch--expanding-inner.switch--horizontal input:hover ~ .toggle-outside .toggle-inside {
  width: 3.5rem;
}
.switch--expanding-inner.switch--horizontal input:hover ~ input:checked ~ .toggle-outside .toggle-inside {
  left: 2.25rem;
}
.switch--expanding-inner.switch--vertical input:hover ~ .toggle-outside .toggle-inside {
  height: 3.5rem;
}
.switch--expanding-inner.switch--vertical input:hover ~ input:checked ~ .toggle-outside .toggle-inside {
  top: 2.25rem;
}

.pnlm-panorama-info{
    display:none !important;
}
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
    margin-right: 1mm;
}
.loadera {
  position: relative;
  text-align: center;
  margin: 15px auto 35px auto;
  z-index: 9999;
  display: block;
  width: 80px;
  height: 80px;
  border: 10px solid rgba(0, 0, 0, .3);
  border-radius: 50%;
  border-top-color: #0681E1;
  animation: spin 1s ease-in-out infinite;
  -webkit-animation: spin 1s ease-in-out infinite;

}

@keyframes spin {
  to {
    -webkit-transform: rotate(360deg);
  }
}

@-webkit-keyframes spin {
  to {
    -webkit-transform: rotate(360deg);
  }
}
.pnlm-hotspot.pnlm-scene {
    background-position: 0px -120px !important;
}
.pnlm-sprite {
    background-image: url("/images/drop2.png") !important;
    width: 60px !important;
    height: 60px !important;
    background-size: 60px auto;
}
.dd-select{
    width: 259px !important;
    background: rgb(238, 238, 238) !important;
}
.dd-desc{
    display:none !important;
}
.dd-options{
    width: 259px !important;
    display: block;
}
.dd-selected{
    overflow: hidden;
    display: block;
    padding: 5px !important;
    font-weight: bold;
}
.dd-option-image, .dd-selected-image{
    vertical-align: middle;
    float: left;
    margin-right: 5px;
    max-width: 75px !important;
}
dd-option-image{    
    height: 9mm !important;
    width: fit-content !important;
}

label {
    display: inline-block;
    margin-bottom: .5rem;
    font-weight: 400 !important;
    margin-top: 6px;
}
div.pnlm-tooltip span {
    visibility: hidden;
    position: absolute;
    border-radius: 3px;
    background-color: white;
    color: green;
    text-align: center;
    max-width: 200px;
    padding: 5px 10px;
    margin-left: -220px;
    cursor: default;
}

div.pnlm-tooltip:hover span:after {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    border-width: 10px;
    border-style: solid;
    border-color: white transparent transparent transparent;
    bottom: -20px;
    left: -10px;
    margin: 0 50%;
}
div.pnlm-tooltip:hover span {
    margin-left: 63.5px !important;
    margin-top: 7px !important;
}
.fiststep{
    background: white;
    width: 52mm;
    height: 9mm;
    margin-left: 70px;
    margin-top: 6px;
}
.dd-selected-description-truncated{
    visibility: hidden !important;
}
</style>

	
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>