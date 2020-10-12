<nav aria-label="Page navigation example">
<ul class="pagination pg-blue">
@php
$pages = isset($page_number) ?$page_number : 10 ;

$actua_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" )."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$linkArray=explode("=",$actua_link);

for($i=1;$i<=$pages;$i++){
if($i==$linkArray[count($linkArray)-1]){
    @endphp
<li class="page-item active"><a class="page-link active" href="?page={{$i}}">{{$i}}</a></li>
@php
}else{
    @endphp
<li class="page-item"><a class="page-link" href="?page={{$i}}">{{$i}}</a></li>
@php
}
}
@endphp


</ul>
</nav>
