@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/docs.theme.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
<style>
.row{
    margin:0 !important;
    max-width:100% !important;
    width:100% !important
}
.owl-carousel .owl-stage-outer{

height:525px !important;

}
</style>
@endsection

@section('content')

<div id="app">
<section>

   <div class="owl-carousel owl-theme">
</div>
</section>
<div class="container">
<h1 class="pageTitle text-info text-center">@{{title}}</h1>
<hr>
<div class="row">
<div class="col-md-3" v-for="article in articles" :key="article.id">

<!-- Card -->

<div class="card" v-if="article.name != ''">
       <div class="view view-cascade overlay">

       <a :href="`/single/media/${article.id}`">
     <img class="card-img-top" :src="`https://image.tmdb.org/t/p/w500/${article.poster_path}`"
      alt="Card image cap" style="height:395px">
      <div class="mask rgba-white-slight"></div>
      </a>
      </div>
  </div> <!--card-->
  <br>
   </div> <!--col-->


</div> <!--row-->
@component("components.pagination",[
'page_number'=>15
]);
@endcomponent
</div>

</div> <!--container-->
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="{{asset('assets/js/owl.carousel.js')}}"></script>
<script>
$(function(){
$(".owl-carousel").owlCarousel({
    loop:true,
    margin:10,
    items:1,
    autoplay:true,
    autoplayTimeout:3000,
    autoHeight:false,
    dots:false,
    nav:true

});
})
</script>
<script>
// $(document).ready(function(){
//     console.log('work')
// })
new Vue({
el:"#app",
data:{

    title:"MovieDB Api Laravel Vue",
    articles:[],
},
created(){
    var self = this;

    let presentUrl=window.location.href; //website href
    let newDate=presentUrl.split('=');
    let pageNumber = newDate[newDate.length-1];


    console.log(pageNumber);

if(!$.isNumeric(pageNumber)){
    pageNumber=1;
}
    var settings = {
                     "async":true,
                     "crossDomain":true,
                     "url":'https://api.themoviedb.org/3/trending/all/day?api_key=ec25a6d5642fe90df3a6cc8ae2fd3f12&language=en-US&page='+pageNumber,
                     "method":"GET",
                     "headers":{
                         "content-type":"application/json;charset=utf-8",
                         "authorization":"Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlYzI1YTZkNTY0MmZlOTBkZjNhNmNjOGFlMmZkM2YxMiIsInN1YiI6IjVmNTNhY2ZiODQ4ZWI5MDAzNzVlNWViZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Jsth8j52zldu8Pxs2jMr571zAjokk46rEoJHWj1wZK8"
                     },
                     "processData":false,
                     "data":"{}"
    }
    $.ajax(settings).done(function (response){
    self.articles = response.results;


    for(let i=0;i<self.articles.length;i++){
         data = '<div class="item">'+
        '<img width="100%"  src="https://image.tmdb.org/t/p/original/'+self.articles[i].backdrop_path+'">'+
        '</div>'
        ;
        $(".owl-carousel").owlCarousel('add',data).owlCarousel('refresh');
    }
    });
}

});
</script>

@endsection
