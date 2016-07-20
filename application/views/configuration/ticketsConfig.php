<title>Configuración de los tickets</title>
<br>
    <h5 class="container center" style="font-weight:300">Configuracion de los Tickets</h5>
<br>
<div class="ticket-config-card container">
   <div class="row" style="width:100%;margin:auto;">

        <span ng-show="$parent.helpers">
            <!-- Help for Tickets configuration list -->
            <div class="col s12 l5">
                <md-card md-theme="blue-grey">
                    <md-card-title>
                        <div layout layout-align="center center">
                            <md-icon ng-style="{'color':'yellow'}">info_outline</md-icon>
                            <span ng-style="{'color':'white', 'margin-left':'10px'}">INFORMACIÓN</span>
                        </div>
                    </md-card-title>
                    <md-divider></md-divider>
                    <md-card-content>
                        <p ng-style="{'color':'white'}">
                            En la Lista de configuraciones se muestran todos las configuraciones de los paramantros de las solicitudes existentes.<br/>
                	        Para editar una configuración, haga click en <i class="material-icons">keyboard_arrow_down</i> de la configuración de su elección.
                	        Para eliminar, click en <i class="material-icons">delete</i>.<br/>
                	        Para cambiar de configuración, click en el switch.<br/>
                	        Para crear una  nueva configuración, haga click en "nuevo" al final de  Detalles de la configuración.
                        </p>
                    </md-card-content>
                </md-card>
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
                        <tr ng-repeat="ticketType in ticketTypes track by $index">
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
        </span>
        <span ng-if="!$parent.helpers">
            <div class="col s12 m6 offset-m3 card">
                <p class="center">Lista de configuraciones</p>
                <table style="width:80%;margin:auto">
                    <thead>
                        <th>#</th>
                        <th>Nombre</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr ng-repeat="ticketType in ticketTypes track by $index">
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
        </span>
    </div>
    <br/>
</div>

<br/>
    <h5 class="container" style="font-weight:300">Configuración Seleccionada</h5>
<br/>

<div ng-show="$parent.helpers" class="row container">
    <!-- Help for selected ticket configuration -->
    <div class="col s12">
        <md-card md-theme="blue-grey">
            <md-card-title>
                <div layout layout-align="center center">
                    <md-icon ng-style="{'color':'yellow'}">info_outline</md-icon>
                    <span ng-style="{'color':'white', 'margin-left':'10px'}">INFORMACIÓN</span>
                </div>
            </md-card-title>
            <md-divider></md-divider>
            <md-card-content>
                <p ng-style="{'color':'white'}">
                    En el panel de abajo se mostrarán los detalles de la configuración seleccionada.<br/>
                    Para crear una nueva configuración, hacer click en "nuevo" al final del panel. Inmediatamente podrá comenzar a editar.<br/>
                    En los campos que corresponda, puede proporcionar varios valores presionando la tecla "comma" ó "enter".
                    El campo Estados tendrá dos valores por defectos: En espera y Cerrado, pero debe proveer más estados.
                </p>
            </md-card-content>
        </md-card>
    </div>
</div>
<div class="ticket-config-card container card-panel" ng-cloack>
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
                <p>Opciones para Tipo de incidente</p>
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
                <p>Opciones para Estado de la solicitud</p>
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
                <p>Opciones para Nivel del ticket</p>
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
                <p>Opciones para Prioridad</p>
                <md-chips
                    readonly="!edit"
                    ng-model="model.priorities"
                    md-separator-keys="customKeys"></md-chips>
                </md-content>
            </div>
            <!-- Quality of services section -->
            <div flex="50">
                <md-content class="md-padding" layout="column">
                <p>Opciones para Calidad de Servicio</p>
                <md-chips
                    readonly="!edit"
                    ng-model="model.qualityOfServices"
                    md-separator-keys="customKeys"></md-chips>
                </md-content>
            </div>
        </div>
        <br/>
        <!-- Max answer times explanation -->
        <div class="md-padding" ng-show="model.priorities.length > 0 && model.types.length > 0" layout="row" layout-align="start center">
            <div class="md-toolbar-tools">
                <p ng-style="{'font-weight':'300'}">Debe proveer un máximo tiempo de respuesta en días para cada par <em>(tipo de incidente, prioridad)</em></p>
            </div>
        </div>
        <div ng-show="model.priorities.length > 0 && model.types.length > 0" layout ng-repeat="(keyT, type) in model.types">
            <div layout layout-align="center center" class="md-padding">
                <p>Para tipo de incidente <em>{{type}} </em></p>
            </div>
            <!-- Max answer times options for each type and priority -->
            <div layout layout-align="center center" ng-repeat="(keyP, priority) in model.priorities">
                <div ng-show="edit">
                    <md-content class="md-padding">
                        <p>Prioridad <em>{{priority}}</em></p>
                        <md-input-container class="md-block">
                        <input aria-label="max-time {{type}}-{{priority}}" ng-model="model.maxAnswerTimes[keyT][keyP]" type="number" step="1" min="1" required>
                        </md-input-container>
                    </md-content>
                </div>
                <div ng-hide="edit">
                    <md-content class="md-padding">
                        <p>Prioridad <em>{{priority}}</em></p>
                        <md-input-container class="md-block">
                        <input readonly aria-label="max-time {{type}}-{{priority}}" ng-model="model.maxAnswerTimes[keyT][keyP]" type="number" step="1" min="1">
                        </md-input-container>
                    </md-content>
                </div>
            </div>
        </div>
        <div layout="row" layout-align="end center">
            <md-button ng-click="newTicketType()" ng-hide="edit" class="md-accent md-raised">Nuevo</md-button>
            <md-button ng-click="editMode()" ng-hide="edit || noUserInput()" class="md-accent md-raised">Editar</md-button>
            <md-button ng-click="save()" ng-show="edit" class="md-accent">Guardar</md-button>
            <md-button ng-click="viewMode()" ng-show="edit" class="md-accent md-raised">Cancelar</md-button>
        </div>
    </div>
</div>
