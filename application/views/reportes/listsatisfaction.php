<md-content ng-if="loading" class="md-padding">
    <div layout layout-align="center center">
        <md-progress-circular md-mode="indeterminate" md-diameter="80"></md-progress-circular>
    </div>
</md-content>

<div ng-cloak ng-if="!loading">
  <md-content id="mainContent">
    <br/>
        <!-- Load Table for tabs todos-->
    <md-card class="card-admin-ticket">
        <md-card-tittle>
        </md-card-tittle>
        <md-card-content>
            <h4> Acontinuacion se muestran las estadisticas para los niveles de satisfaccion de los usuarios</h4>
            <br/> <br/>
            <div ng-repeat="qualityOfServices in static">
                <p>{{qualityOfServices.name}}</p>
                 <div layout="row">
                    <div flex="40" flex-offset="35" >
                        {{qualityOfServices.value}} / {{todas}} <span>({{(qualityOfServices.value * 100) / todas | number:2}}%)</span>
                    </div>
                </div>
                <div layout="row">
                    <div flex="40" layout-align="center">
                        <md-progress-linear md-mode="determinate" value="{{(qualityOfServices.value * 100) / todas}}"></md-progress-linear>    
                    </div>
                </div>
                <br/>
            </div>
 
       </md-card-content>
        
    </md-card>
    <br/>
  </md-content>
</div>
