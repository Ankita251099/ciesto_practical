<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Spin & Wheel | @yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
     <link href="{{asset('lib/css/emoji.css')}}" rel="stylesheet">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('vendor/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    

<!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

 -->
<link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
  <!-- <link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.css')}}">

  <link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
</head> -->
<style>
.quixnav{
    overflow: scroll;
}

.onoffswitch {
    position: relative; width: 100px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "Open";
    padding-left: 10px;
    background-color: green; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "Close";
    padding-right: 10px;
    background-color: red; color: #FFFFFF;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 46px; margin: 2px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 50px;
    border: 2px solid #999999; border-radius: 20px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px;
}

.onoffswitch1{
    position: relative; width: 122px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox1{
    display: none;
}
.onoffswitch-label1 {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}
.onoffswitch-inner1 {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner1:before, .onoffswitch-inner1:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner1:before {
    content: "Active";
    padding-left: 10px;
    background-color: green; color: #FFFFFF;
}
.onoffswitch-inner1:after {
    content: "Inactive";
    padding-right: 10px;
    background-color: red; color: #FFFFFF;
    text-align: right;
}
.onoffswitch-switch1 {
    display: block; width: 40px; margin: 2px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 80px;
    border: 2px solid #999999; border-radius: 20px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox1:checked + .onoffswitch-label1 .onoffswitch-inner1 {
    margin-left: 0;
}
.onoffswitch-checkbox1:checked + .onoffswitch-label1 .onoffswitch-switch1 {
    right: 0px; 
}

</style>