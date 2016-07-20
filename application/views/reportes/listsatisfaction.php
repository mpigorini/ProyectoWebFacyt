<br/>
<div class="md-padding" layout layout-align="center center">
    <h5 class="card-admin-ticket" ng-style="{'font-weight':'300'}"> A continuación se muestran las estadísticas para los niveles de satisfacción de los usuarios</h5>
</div>
<br/>
<div ng-cloak>
  <md-content id="mainContent">
    <br/>
    <md-card class="card-admin-ticket">
        <md-card-content>
            <div ng-repeat="qualityOfServices in static">
                <p>{{qualityOfServices.name}}</p>
                 <div layout="row">
                    <div flex="40" flex-offset="35" >
                        {{qualityOfServices.value}} / {{todas}} <span>({{(qualityOfServices.value * 100) / todas | number:2}}%)</span>
                    </div>
                </div>
                <div layout="row">
                    <div flex="40" layout-align="center">
                        <md-progress-linear  md-mode="determinate" value="{{(qualityOfServices.value * 100) / todas}}"></md-progress-linear>
                    </div>
                </div>
                <br/>
            </div>

       </md-card-content>

    </md-card>
    <br/>
  </md-content>
</div>
