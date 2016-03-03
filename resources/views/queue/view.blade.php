
@extends('layouts.login')


@section('content')
<style>
  .teller { text-align: center; height: 250px; padding: 5px; border: 1px solid #ccc; }
  .current { font-size: 30px; color: #f00;}
  .next { font-size: 25px; color: #0f0;}
  .teller h1 { font-weight: bold; color: #00b; }
</style>
        <div class="containerz">
            <div class="box">
                <div class="box2"> 
                   <div class="header">
                      <div class="container">
                          <div class="logo">
                            <h1><a href="index.html">LTO QUEUE MANAGEMENT SYSTEM</a></h1>
                          </div>
                        <div class="top-nav">
                          <ul class="right-icons">
                            <li><a href="{{ URL::to('/') }}"><i class="glyphicon glyphicon-user"></i>Home page</a></li>                            
                          </ul>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<br/>
  <div class="container">
    <div class="row">
      <div class="col-md-4 teller">
        <h1>Teller 1</h1>
        <p class="current">Serving: {{ $teller1 }}</p>
        <p class="next">Next: {{ $teller_n1 }}</p>
      </div>
      <div class="col-md-4 teller">
        <h1>Teller 2</h1>
        <p class="current">Serving: {{ $teller2 }}</p>
        <p class="next">Next: {{ $teller_n2 }}</p>
      </div>
      <div class="col-md-4 teller">
        <h1>Teller 3</h1>
        <p class="current">Serving: {{ $teller3 }}</p>
        <p class="next">Next: {{ $teller_n3 }}</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 teller">
        <h1>Teller 4</h1>
        <p class="current">Serving: {{ $teller4 }}</p>
        <p class="next">Next: {{ $teller_n4 }}</p>
      </div>
      <div class="col-md-4 teller">
        <h1>Teller 5</h1>
        <p class="current">Serving: {{ $teller5 }}</p>
        <p class="next">Next: {{ $teller_n5 }}</p>
      </div>
      <div class="col-md-4 teller">
        <h1>Teller 6</h1>
        <p class="current">Serving: {{ $teller6 }}</p>
        <p class="next">Next: {{ $teller_n6 }}</p>
      </div>
    </div>
  </div>

</div> 
  </div>
                </div>   
            </div>
            
      

<script>
$(function(){
  setInterval(function(){
    window.location.reload();
  },2000);

});
</script>


@stop 