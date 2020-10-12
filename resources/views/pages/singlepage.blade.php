@extends('layouts.frontend')
@section('styles')
<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/docs.theme.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
<style>
.owl-stage-outer .owl-height{

    height:450px !important;
}
</style>
@endsection

@section('content')
<div class="container" id="app">

<div class="row">
<div class="col-md-5" style="margin-top:20px">
  <!--Section: Content-->
  <section class="mx-md-5 dark-grey-text">



      <!-- Grid column -->
      <div class="col-md-12">

        <!-- Card -->
        <div class="card card-cascade wider reverse">

          <!-- Card image -->
          <div class="view view-cascade overlay">
            <img class="card-img-top" width="100%" :src="`https://image.tmdb.org/t/p/w500/${details.poster_path}`" alt="Sample image">
            <a href="#!">
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>

          <!-- Card content -->
          <div class="card-body card-body-cascade text-center">

            <!-- Title -->
            <h3 class="font-weight-bold"><a>@{{details.title}}</a></h3>
            <!-- Data -->
            <p>Status: <a><strong>@{{details.status}}</strong></a>, @{{details.release_date}}</p>

              <ul class="list-group" style="margin-left:0px">
              <li class="list-group-item">Language:@{{details.original_language}}</li>
              <li class="list-group-item">Run Time:@{{details.runtime}}</li>
              <li class="list-group-item">Popularity:@{{details.popularity}}</li>
              <li class="list-group-item">Adult Content:@{{details.adult}}</li>


    <li class="list-group-item" v-if="details.budget >0 ">Budget: @{{details.budget}}</li>
    <li class="list-group-item" v-if="details.homepage !='' ">Website: @{{details.homepage}}</li>
    <li class="list-group-item"v-if="details.revenue >0 ">Revenue: @{{details.revenue}}</li>
    <li class="list-group-item" v-if="details.tagline !='' ">Tagline: @{{details.tagline}}</li>
    <li class="list-group-item" v-if="details.vote_average !='' ">Rating: @{{details.vote_average}}</li>


              </ul>

          </div>
          <!-- Card content -->

        </div>
        <!-- Card -->


      </div>
      <!-- Grid column -->





  </section>
  <!--Section: Content-->
</div>

<div class="col-md-7" style="margin-top:20px">
<div v-for="video in videos" :key="video.id">




  <!-- Section: Block Content -->
  <section>


  <iframe id="player" class="embed-responsive-item" width="100%" height="350px" :src="`https://www.youtube.com/embed/${video.key}`" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

  </section>
  <!-- Section: Block Content -->


</div><!---video-->

</div>
</div>
<!-- Excerpt -->
<div class="mt-5">
<h2 class="text-info">Overview</h2>
<p>
@{{singlearticle.overview}}
</p>
<br>
<hr>
<br>
</div>


<section>
<div class="row">
 <div class="large-12 colums">
   <div class="owl-carousel owl-theme">

   </div>
 </div>
</div>
</section>
<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://dhra-movie.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>



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
    item:3,
    autoplay:true,
    autoplayTimeout:2000,
    autoHeight:true

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

    title:"Movie App",
    singlearticle:[],
    videos:[],
    similars:[],
    details:[]
},

created(){
    var self = this;

    let presentUrl=window.location.href; //website href
    let newDate=presentUrl.split('/');
    let id = newDate[newDate.length-1];


    console.log(typeof(id));


    var settings = {
                     "async":true,
                     "crossDomain":true,
                     "url":'https://api.themoviedb.org/3/movie/'+id+'?api_key=ec25a6d5642fe90df3a6cc8ae2fd3f12&language=en-US',
                     "method":"GET",
                     "headers":{
                         "content-type":"application/json;charset=utf-8",
                         "authorization":"Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlYzI1YTZkNTY0MmZlOTBkZjNhNmNjOGFlMmZkM2YxMiIsInN1YiI6IjVmNTNhY2ZiODQ4ZWI5MDAzNzVlNWViZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Jsth8j52zldu8Pxs2jMr571zAjokk46rEoJHWj1wZK8"
                     },
                     "processData":false,
                     "data":"{}"
    }
    $.ajax(settings).done(function (response){
    self.singlearticle = response;
    console.log(self.singlearticle)
    });

    setTimeout(() => {
        var video = {
                     "async":true,
                     "crossDomain":true,
                     "url":'https://api.themoviedb.org/3/movie/'+id+'/videos?api_key=ec25a6d5642fe90df3a6cc8ae2fd3f12&language=en-US',
                     "method":"GET",
                     "headers":{
                         "content-type":"application/json;charset=utf-8",
                         "authorization":"Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlYzI1YTZkNTY0MmZlOTBkZjNhNmNjOGFlMmZkM2YxMiIsInN1YiI6IjVmNTNhY2ZiODQ4ZWI5MDAzNzVlNWViZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Jsth8j52zldu8Pxs2jMr571zAjokk46rEoJHWj1wZK8"
                     },
                     "processData":false,
                     "data":"{}"
    }
    $.ajax(video).done(function (response){
    self.videos = response.results;
    console.log(self.videos)
    });

    }, 2000);

    setTimeout(() => {
        var similar = {
                     "async":true,
                     "crossDomain":true,
                     "url":'https://api.themoviedb.org/3/movie/'+id+'/similar?api_key=ec25a6d5642fe90df3a6cc8ae2fd3f12&language=en-US',
                     "method":"GET",
                     "headers":{
                         "content-type":"application/json;charset=utf-8",
                         "authorization":"Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlYzI1YTZkNTY0MmZlOTBkZjNhNmNjOGFlMmZkM2YxMiIsInN1YiI6IjVmNTNhY2ZiODQ4ZWI5MDAzNzVlNWViZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Jsth8j52zldu8Pxs2jMr571zAjokk46rEoJHWj1wZK8"
                     },
                     "processData":false,
                     "data":"{}"
    }
    $.ajax(similar).done(function (response){
    self.similars = response.results;
    console.log(self.similars)
    for(let i=0;i<self.similars.length;i++){
         data = '<div class="item">'+
        '<img width:"400px"  src="https://image.tmdb.org/t/p/w500/'+self.similars[i].poster_path+'">'+
        '</div>'
        ;
        $(".owl-carousel").owlCarousel('add',data).owlCarousel('refresh');
    }

    });

    }, 3000);
},
mounted(){
    var self = this;

let presentUrl=window.location.href; //website href
let newDate=presentUrl.split('/');
let id = newDate[newDate.length-1];


    var detailsOfMovie = {
                     "async":true,
                     "crossDomain":true,
                     "url":'https://api.themoviedb.org/3/movie/'+id+'?api_key=ec25a6d5642fe90df3a6cc8ae2fd3f12&language=en-US',
                     "method":"GET",
                     "headers":{
                         "content-type":"application/json;charset=utf-8",
                         "authorization":"Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJlYzI1YTZkNTY0MmZlOTBkZjNhNmNjOGFlMmZkM2YxMiIsInN1YiI6IjVmNTNhY2ZiODQ4ZWI5MDAzNzVlNWViZCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Jsth8j52zldu8Pxs2jMr571zAjokk46rEoJHWj1wZK8"
                     },
                     "processData":false,
                     "data":"{}"
    }
    $.ajax(detailsOfMovie).done(function (response){
    self.details = response;
    console.log(self.details)


    });


}


});
</script>
@endsection
