@extends('layouts.frontend')
@section('styles')
<style>
.row{
    margin:0 !important;
    max-width:100% !important;
    width:100% !important
}
</style>
@endsection

@section('content')
<div class="container" id="app">
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
@component("components.pagination")
@endcomponent
</div> <!--container-->
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
// $(document).ready(function(){
//     console.log('work')
// })
new Vue({
el:"#app",
data:{

    title:"Popular TV Show",
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
                     "url":'https://api.themoviedb.org/3/tv/popular?api_key=ec25a6d5642fe90df3a6cc8ae2fd3f12&language=en-US&page='+pageNumber,
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
    console.log(self.articles)
    });
}

});
</script>
@endsection
