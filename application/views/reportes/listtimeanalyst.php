<div ng-controller="ListtimeanalystCtrl">

<div class="row"  >


  <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s4 offset-s2">
          <input ng-model="date.StartTime" placeholder="" id="first_name" type="date" class="validate">
          <label for="first_name"></label>
        </div>
        <div class="input-field col s4 offset-s1">
          <input  ng-model="date.EndTime" id="last_name" type="date" class="validate">
          <label for="last_name"></label>
        </div>
      </div>
     
      <div class="row">
        <div class="input-field col s4 offset-s2">
          <input ng-model="date.Analyst" id="name" type="text" class="validate">
          <label for="Name">Name Analyst</label>
        </div>
      </div>
    </form>
  </div>
        
  <div class="col s2 offset-s5">
    <button ng-click="search()" class="btn waves-effect waves-light " type="submit" name="action">Search
      <i class="material-icons right">search</i>
    </button>
  </div>

<br>
<br>
	
  <div class="col s2">

    <h2 ng-show="title" class="left" >Reportes</h2> 
  </div>

  <div ng-show="table" class="container"> 

  	<br>
    <br><br>
	  
    <div class="section">
      <label class="left" >Total De solicitudes: {{total}} </label>
    </div>
    

    <div class="section">
      <label for=""> Total Atendidas: {{(atendidas*100)/total}} %</label>
      <div class="progress">
        <div class="determinate" style="width: {{(atendidas*100)/total}}%"></div>
      </div>
    </div>  

    <div class="section">
      <label for=""> Total en espera: {{(espera*100)/total}} %</label>
      <div class="progress">
        <div class="determinate" style="width: {{(espera*100)/total}}%"></div>
      </div>
        
    </div>
    <div class="section">
      <label for="">Total que exedieron : {{(exedieron*100)/total}} % </label>
      <div class="progress">
      <div class="determinate" style="width: {{(exedieron*100)/total}}%"></div>
      </div>
      
    </div>

 </div>
</div>



 

  </div>