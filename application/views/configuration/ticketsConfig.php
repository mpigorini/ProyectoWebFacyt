<title>Configuración de los tickets</title>
<br>
    <h5 class="container center" style="font-weight:300">Configuracion de los Tickets</h5>
<br>
<div class="ticket-config-card container">
   <div class="row" style="width:100%;margin:auto;">
       <div class="col s12 l5 card-panel blue-grey darken-1">
            <p class="white-text">
    	        En la Lista de configuraciones se muestran todos las configuraciones de los paramantros de las solicitudes existentes.<br/>
    	        Para editar una configuración, haga click en <i class="material-icons">keyboard_arrow_down</i> de la configuración de su elección.
    	        Para eliminar, click en <i class="material-icons">delete</i>.<br/>
    	        Para cambiar de configuración, click en el switch.<br/>
    	        Para crear una  nueva configuración, haga click en "nuevo" al final de  Detalles de la configuración.
            </p>
    	</div>
        <div class="col l1"></div>
        <div class="col s12 l6 card" style="float:right">
            <p class="center">Lista de configuraciones</p>
            <table style="width:80%;margin:auto">
                <thead>
                    <th>#</th>
                    <th>Nombre</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <tr ng-repeat="ticketType in ticketTypes">
                        <td>{{$index+1}}</td>
                        <td>{{ticketType.name}}</td>
                        <td><a class="btn-floating waves-effect waves-light" ng-click="loadTicketType($index)"><i class="material-icons">keyboard_arrow_down</i></a></td>
                        <td><a class="btn-floating waves-effect waves-light red" ng-click="delete($index)"><i class="material-icons">delete</i></a></td>
                        <td ng-hide="isActive($index)">
                          <div class="switch">
                            <label>
                              <input type="checkbox" ng-checked="isActive($index)" ng-click="setAsActive($index)">
                              <span class="lever"></span>
                            </label>
                          </div>
                        </td>
                        <td ng-show="isActive($index)">
                          <div class="switch">
                            <label>
                              <input checked disabled type="checkbox">
                              <span class="lever"></span>
                            </label>
                          </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    
    </div>
    <br/>
</div>
 
<br/>
    <h5 class="container" style="font-weight:300">Configuración Seleccionada</h5>
<br/>
<div class="row container">
    <div class="col s12 card-panel blue-grey darken-1">
        <p class="white-text">
            En el panel de abajo se mostrarán los detalles de la configuración seleccionada.<br/>
            Para crear una nueva configuración, hacer click en "nuevo" al final del panel. Inmediatamente podrá comenzar a editar.<br/>
            En los campos que corresponda, puede proporcionar varios valores presionando la tecla "comma" ó "enter".
            El campo Estados tendrá dos valores por defectos: En espera y Cerrado, pero debe proveer más estados.
        </p>
    </div>
</div>
<div class="ticket-config-card container card-panel" ng-cloack>
      
    <!--
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
                <div class="chip" ng-repeat="state in statesArray">
                    {{state}}
                    <i class="material-icons">close</i>
                </div>
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
    -->
    <div class="row" style="margin-left:20px; margin-right:20px">
        <div layout="row">
            <!-- Name section -->
            <div flex="50" ng-show="edit">
                <md-content class="md-padding" layout="column">
                <p>Nombre de la configuración</p>
                    <md-input-container>
                        <input aria-label="name" ng-model="model.name">
                    </md-input-container>
                </md-content>
            </div>
            <div flex="50" ng-hide="edit">
                <md-content class="md-padding" layout="column">
                <p>Nombre de la configuración</p>
                <md-input-container class="md-block">
                    <input aria-label="name" ng-model="model.name" readonly>
                    </md-input-container>
                </md-content>
            </div>
            <!-- Types section -->
            <div flex="50">
                <md-content class="md-padding" layout="column">
                <p>Opciones para Tipos de incidente</p>
                <md-chips
                    readonly="!edit"
                    ng-model="model.types"
                    md-separator-keys="customKeys">
                </md-chips>
                </md-content>
            </div>
        </div>
        <div layout="row">
            <!-- States section -->
            <div flex="50">
                <md-content class="md-padding" layout="column">
                <p>Opciones para Estados de la solicitud</p>
                <md-chips
                    readonly="true"
                    ng-model="defaultStates">
                </md-chips>
                <md-chips
                    readonly="!edit"
                    ng-model="model.states"
                    md-separator-keys="customKeys">
                </md-chips>
                </md-content>
            </div>
            <!-- Levels section -->
            <div flex="50">
                <md-content class="md-padding" layout="column">
                <p>Opciones para Niveles del ticket</p>
                <md-chips
                    readonly="!edit"
                    ng-model="model.levels"
                    md-separator-keys="customKeys"></md-chips>
                </md-content>
            </div>
        </div>
        <div layout="row">
            <!-- Priorities section -->
            <div flex="50">
                <md-content class="md-padding" layout="column">
                <p>Opciones para Prioridades</p>
                <md-chips
                    readonly="!edit"
                    ng-model="model.priorities"
                    md-separator-keys="customKeys"></md-chips>
                </md-content>
            </div>
            <!-- Answer Times section -->
            <div flex="50">
                <md-content class="md-padding" layout="column">
                <p>Opciones para Tiempos de respuesta</p>
                <md-chips
                    readonly="!edit"
                    ng-model="model.answerTimes"
                    md-separator-keys="customKeys"></md-chips>
                </md-content>
            </div>
        </div>
        <div class="row right-align" >
            <md-button ng-click="newTicketType()" ng-hide="edit" class="md-primary md-raised">Nuevo</md-button>
            <md-button ng-click="editMode()" ng-hide="edit || noUserInput()" class="md-primary md-raised">Editar</md-button>
            <md-button ng-click="save()" ng-show="edit" class="md-primary">Guardar</md-button>
            <md-button ng-click="viewMode()" ng-show="edit" class="md-primary md-raised">Cancelar</md-button>
        </div>
    </div>
</div>