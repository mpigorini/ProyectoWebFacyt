

<div class="row" ng-controller="ListtimeCtrl" >

 
  <div class="col s2  offset-s2">
    <strong > Input start Time </strong>
    <input name="StartTime"  type="date" required="date">
  </div>
  <div class="col s2 offset-s1">
    <strong> Input end Time </strong>
    <input name="EndTime"  type="date" required="date">
  </div>

  <div class="col s2 offset-s1">
    <button ng-click="search()" class="btn waves-effect waves-light " type="submit" name="action">Search
        <i class="material-icons right">search</i>
    </button>
  </div>
<br>
<br>	
  <div class="section">

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
