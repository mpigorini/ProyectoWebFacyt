<h1 class="center">Configuración de los Tickets</h1>
<p class="center">Aquí se configurarán los parámetros de los tickes</p>
<div class="ticket-config-card container card">
   <h5 style="padding-top:20px; margin-left:20px"><strong >Lista de configuraciones</strong></h5>
    
    <br/>
    
    <table style="width:80%;margin:auto">
        <thead>
            <th>#</th>
            <th>Nombre</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <tr ng-repeat="ticketType in ticketTypes">
                
                <td>{{$index}}</td>
                <td>{{ticketType.name}}</td>
                <td><a class="btn" ng-click="loadTicketType($index)">Ver</a></td>
                <td><a class="btn">Eliminar</a></td>
            </tr>
        </tbody>
    </table>
    <br/>
    
    <h5 style="padding-top:20px; margin-left:20px"><strong >Configuracion Seleccionada</strong></h5>
    
    <br/>
    <div class="row" style="margin-left:20px; margin-right:20px">
        <form>
            <div class="row valign-wrapper ">
                <div class="col s2 right-align valign "><strong>Nombre :</strong></div>
                <div class="col s3" ng-show="edit"><input ng-model="model.name"></div>
                <div class="col s3" ng-show="!edit"><input disabled ng-model="model.name"></div>
                <div class="col s2"></div>
                <div class="col s2 right-align valign"><strong>Estados :</strong></div>
               <div class="col s3" ng-show="edit"><textarea class="materialize-textarea" ng-model="model.states"></textarea></div>
                <div class="col s3" ng-show="!edit"><textarea disabled class="materialize-textarea" ng-model="model.states"></textarea></div>
            </div>
            <div class="row teal lighten-5 valign-wrapper">
                <div class="col s2 right-align valign "><strong>Tipos :</strong></div>
                <div class="col s3" ng-show="edit"><textarea class="materialize-textarea" ng-model="model.types"></textarea></div>
                <div class="col s3" ng-show="!edit"><textarea disabled class="materialize-textarea" ng-model="model.types"></textarea></div>
                <div class="col s2"></div>
                <div class="col s2 right-align valign"><strong>Niveles :</strong></div>
                <div class="col s3" ng-show="edit"><textarea class="materialize-textarea" ng-model="model.levels"></textarea></div>
                <div class="col s3" ng-show="!edit"><textarea disabled class="materialize-textarea" ng-model="model.levels"></textarea></div>
            </div>
              <div class="row valign-wrapper ">
                <div class="col s2 right-align valign "><strong>Prioridades :</strong></div>
                <div class="col s3" ng-show="edit"><textarea class="materialize-textarea" ng-model="model.priorities"></textarea></div>
                <div class="col s3" ng-show="!edit"><textarea disabled class="materialize-textarea" ng-model="model.priorities"></textarea></div>
                <div class="col s2"></div>
                <div class="col s2 right-align valign"><strong>Timepo de Respuestas :</strong></div>
               <div class="col s3" ng-show="edit"><textarea class="materialize-textarea" ng-model="model.answerTimes"></textarea></div>
                <div class="col s3" ng-show="!edit"><textarea disabled class="materialize-textarea" ng-model="model.answerTimes"></textarea></div>
            </div>
              
        </form>
        <div class="row right-align">

            <a class="btn" ng-click="newTicketType()" ng-show="!edit">Nuevo</a>
            <a class="btn" ng-click="editMode()" ng-show="!edit && (model.name != null)">Editar</a>
            <a class="btn" ng-click="save()" ng-show="edit">Guardar</a>
            <a class="btn" ng-click="viewMode()" ng-show="edit">Cancelar</a>
        </div>
    </div>
</div>