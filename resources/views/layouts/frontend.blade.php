<!DOCTYPE html>
<html>
<head>
<title>MovieDB Api Project Laravel</title>


<!-- <link  href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet"> -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">

<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.15.0/css/mdb.min.css" rel="stylesheet">
 <!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<style>
.pageTitle{

    padding:50px;
    padding-top:30px

}
.loader{

    width: 100%;
    height: 100%;
    position: fixed;
    padding-top: 306px;
    background: #333;
    padding-left: 677px;
    margin: 0 auto;
    z-index: 99999;
}
.searchBox{
    color: #fff;

    cursor: pointer;
}

.searchField{
    display:none;
    width: 100%;
    height: 100%;
    position: fixed;
    padding-top: 20%;
    background: #333;
    padding-left: 20%;

    z-index: 99999;
}
#searchInput{
    color: #fff;
    background: #333;
    width: 65%;
    padding: 20px;
    border: none;
    font-size:25px;
    border-bottom: solid 1px #fff !important;
}
.fas{
    font-size:33px;
    color:#fff;
    cursor:pointer;
}
.search_error{
    color:red;
}
.eachMovie{
    color:#fff
}
.eachMovie img{
    height:100px;
    width:70px;
    padding:8px;
}
.searchDropdown{
    overflow-x:scroll !important;
    height:302px;
    width:65%;
    display:none;
}

</style>
@yield('styles')
</head>

<body>
<div class="loader">
<img src="{{asset('/assets/img/circles.svg')}}">
</div>
<div class="searchField">
<form class="form searchForm">
<input type="text" placeholder="Search Here" name="search" id="searchInput" class="searchInput">
<i class="fas fa-search"></i>
<br>
<span class="search_error"></span>
</form>
<div class="searchDropdown">

</div>
</div>
@include('includes._header')

@yield('content')
@include('includes._footer')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"></script>


<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.15.0/js/mdb.min.js"></script>
 <script>
 $(function(){
     setTimeout(()=>{
        $(".loader").fadeOut(500);
     },900)


 });
 $(".searchButton").click(function(e){
     $('.searchField').fadeIn(500);
     e.stopPropagation();
 });

 $(".searchForm").click(function(e){
     e.stopPropagation();
 });
 $(document).click(function(){
     $('.searchField').hide();
 }
 )

//code for handling search
$(".fa-search").on("click",function(e){
     let searchTerm = $("#searchInput").val();
     if(searchTerm.length>3){
      $.ajax({
                     type:"GET",
                     dataType:'json',
                     contentType:"application/json;charset=utf-8",
                     url:"/search/movies/"+searchTerm,

                     success:function(response){

                         $(".searchDropdown").html('');
                         if(response.results.length>0){
                            $(".searchDropdown").show();

                         }else{
                            $(".searchDropdown").show();
                            $(".searchDropdown").append("<h3 style='color:blue'>No Results Found</h3>");
                            $(".searchDropdown").fadeOut(6000);
                         }
                         for(let i=0;i<response.results.length;i++){
                            $(".searchDropdown").append('<div class="eachMovie"><a href="/single/media/'+response.results[i].id+'"><img  src="https://image.tmdb.org/t/p/w500/'+response.results[i].poster_path+'">'+response.results[i].title+"</img></a></div>");
                         }
                     }
              });

              $(".search_error").html(' ');

     }else{
       $(".search_error").html("Add More Characters To Search");

     }
 });

 </script>
  @yield('scripts')
</body>
</html>
