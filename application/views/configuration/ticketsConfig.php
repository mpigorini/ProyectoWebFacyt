<h1 class="center">Configuración de los Tickets</h1>
    <br>
        <h5 class="container" style="font-weight:300">Lista de Configuraciones</h5>
    <br>
<div class="ticket-config-card container ">
   <div class="row" style="width:100%;margin:auto;">
       <div class="col s12 l5  card-panel blue-grey darken-1">
    	        <p class="white-text">
        	        En la Lista de departamentos se muestran todos los departamentos existentes.<br/>
        	        Para editar un departamento, haga click en <i class="material-icons">keyboard_arrow_down</i> del departamento de su elección.
        	        Para eliminar, click en <i class="material-icons">delete</i><br/>
        	        Para crear un nuevo departamento, haga click en "nuevo" al final de Detalles del departamento.
    	        </p>
    	</div>
        <div class="col l2"></div>
        <div class="col s12 l5  card" style="float:right">
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
                        <td><a class="btn-floating waves-effect waves-light" ng-click="loadTicketType($index)"><i class="material-icons">keyboard_arrow_down</i></a></td>
                        <!--<td><a class="btn-floating waves-effect waves-light" ng-click="loadTicketType($index)"><i class="material-icons">arrow_downward</i></a></td>-->
                        <td><a class="btn-floating waves-effect waves-light red" ng-click="delete($index)"><i class="material-icons">delete</i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    
    </div>
    <br/>
</div>
 
    <br>
        <h5 class="container" style="font-weight:300">Configuracion Seleccionada</h5>
    <br>

<div class="ticket-config-card container card">
      
    
    <div class="row" style="margin-left:20px; margin-right:20px">
        <form>
            <div class="row valign-wrapper ">
                <div class="col s2 right-align valign "><strong>Nombre :</strong></div>
                <div class="col s3" ng-show="edit"><input ng-model="model.name"></div>
                <div class="col s3" ng-show="!edit"><input readonly ng-model="model.name"></div>
                <div class="col s1"></div>
                <div class="col s2 right-align valign"><strong>Estados :</strong></div>
                <div class="col s3" ng-show="edit"><textarea class="materialize-textarea" ng-model="model.states"></textarea></div>
                <div class="col s3" ng-show="!edit"><textarea readonly class="materialize-textarea" ng-model="model.states"></textarea></div>
                <div class="col s1"></div>
            </div>
            <div class="row valign-wrapper">
                <div class="col s2 right-align valign "><strong>Tipos :</strong></div>
                <div class="col s3" ng-show="edit"><textarea class="materialize-textarea" ng-model="model.types"></textarea></div>
                <div class="col s3" ng-show="!edit"><textarea readonly class="materialize-textarea" ng-model="model.types"></textarea></div>
                <div class="col s1"></div>
                <div class="col s2 right-align valign"><strong>Niveles :</strong></div>
                <div class="col s3" ng-show="edit"><textarea class="materialize-textarea" ng-model="model.levels"></textarea></div>
                <div class="col s3" ng-show="!edit"><textarea readonly class="materialize-textarea" ng-model="model.levels"></textarea></div>
                <div class="col s1"></div>
            </div>
              <div class="row valign-wrapper ">
                <div class="col s2 right-align valign "><strong>Prioridades :</strong></div>
                <div class="col s3" ng-show="edit"><textarea class="materialize-textarea" ng-model="model.priorities"></textarea></div>
                <div class="col s3" ng-show="!edit"><textarea readonly class="materialize-textarea" ng-model="model.priorities"></textarea></div>
                <div class="col s1"></div>
                <div class="col s2 right-align valign"><strong>Timepo de Respuestas :</strong></div>
                <div class="col s3" ng-show="edit"><textarea class="materialize-textarea" ng-model="model.answerTimes"></textarea></div>
                <div class="col s3" ng-show="!edit"><textarea readonly class="materialize-textarea" ng-model="model.answerTimes"></textarea></div>
                <div class="col s1"></div>
            </div>
              
        </form>
        <div class="row right-align" >

            <a class="btn" ng-click="newTicketType()" ng-show="!edit">Nuevo</a>
            <a class="btn" ng-click="editMode()" ng-show="!edit && (model.name != null)">Editar</a>
            <a class="btn" ng-click="save()" ng-show="edit">Guardar</a>
            <a class="btn" ng-click="viewMode()" ng-show="edit">Cancelar</a>
        </div>
    </div>
</div>