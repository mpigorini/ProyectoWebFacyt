<div ng-cloak>
  <md-content>
    <md-tabs md-dynamic-height md-border-bottom md-stretch-tabs="always">
        <!-- Init tabs Todos -->
        <md-tab label="Todas" md-on-select="clearModel()">
            <md-content >
                <br/>
                <!-- Load Table for tabs todos-->
                <md-card class="card-admin-ticket">
                    <md-card-tittle>
                    </md-card-tittle>
                    <md-card-content>
                        <md-toolbar class="md-table-toolbar md-default">
                          <div class="md-toolbar-tools">
                            <span>Tickets</span>
                          </div>
                        </md-toolbar>
                        <md-table-container>
                          <table md-table md-row-select ng-model="selected" md-progress="promise" >
                            <thead md-head md-order="query.order">
                              <tr md-row>
                                <th md-column><span>Asunto</span></th>
                                <th md-column ><span>Descripcion</span></th>
                                <th md-column >Tipo</th>
                                <th md-column >Nivel</th>
                                <th md-column >Prioridad</th>
                                <th md-column >Tiempo de Respuesta</th>
                                <th md-column >Solicitante</th>
                              </tr>
                            </thead>
                            <tbody md-body>
                              <tr md-row md-select="ticket"  md-on-select="selectItem" md-on-deselect="deselectItem" ng-repeat="ticket in tickets | orderBy: ticket.subject | limitTo: query.limit: (query.page - 1) * query.limit">
                                <td md-cell>{{ticket.subject}}</td>
                                <td md-cell>{{ticket.description}}</td>
                                <td md-cell>{{ticket.type}}</td>
                                <td md-cell>{{ticket.level}}</td>
                                <td md-cell>{{ticket.priority}}</td>
                                <td md-cell>{{ticket.answerTime}}</td>
                                <td md-cell>{{ticket.userReporter.name}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </md-table-container>
                        
                        <md-table-pagination md-limit="query.limit" md-limit-options="[5, 10, 15]" md-page="query.page" md-total="{{tickets.length}}" md-page-select></md-table-pagination>
                    </md-card-content>
                </md-card>
                <br/>
                <!-- Load summary for tabs Todos-->
                <md-card ng-show="ticketSelected" class="card-admin-ticket">
                   <md-card-tittle></md-card-tittle> 
                   <md-card-content>
                        <div class="md-toolbar-tools">
                            <span>Descripcion del Ticket</span>
                        </div>
                        <form name="adminTicket">
                            <div layout="row">
                                <div flex="45">
                                    <md-input-container class="md-block">
                                        <label>Asunto</label>
                                        <textarea readonly ng-model="model.subject"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="45" flex-offset="10">
                                      <md-input-container  class="md-block">
                                        <label>Descripcion</label>
                                        <textarea  readonly ng-model="model.description"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                            <div layout="row">
                                <div flex="30">
                                    <md-input-container class="md-block">
                                        <label>Tipo</label>
                                        <textarea readonly ng-model="model.type"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container  class="md-block">
                                        <label>Nivel</label>
                                        <textarea readonly ng-model="model.level"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                      <md-input-container  class="md-block">
                                        <label>Prioridad</label>
                                         <textarea readonly ng-model="model.priority"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                            <div layout="row">
                                <div flex="30">
                                    <md-input-container class="md-block">
                                        <label>Usuario</label>
                                        <textarea readonly ng-model="model.userReporter.name"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container  class="md-block">
                                       <label>Departamento</label>
                                        <textarea readonly ng-model="model.department"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                      <md-input-container  class="md-block">
                                         <label>Estado</label>
                                        <md-select ng-disabled="!edit"  placeholder="Estados" ng-model="model.state"  style="min-width: 200px;">
                                        <md-option ng-value="state" ng-repeat="state in config.states">{{state}}</md-option>
                                    </md-input-container>
                                </div>
                            </div>
                             <div layout="row">
                                <div flex="30">
                                    <md-input-container class="md-block">
                                        <label>Fecha de creacion</label>
                                        <textarea readonly ng-model="model.submitDate"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container  class="md-block">
                                       <label>Tiempo de respuesta</label>
                                        <textarea readonly ng-model="model.answerTime"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container class="md-block">
                                        <label>Fecha de cierre</label>
                                        <textarea readonly ng-model="model.closeDate"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                            <div layout="row">
                                <div flex="45">
                                    <md-input-container class="md-block">
                                        <label>Descripcion de la solucion</label>
                                        <textarea ng-disabled="!edit" ng-model="model.solutionDescription"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="45" flex-offset="10">
                                      <md-input-container  class="md-block">
                                        <label>Observaciones</label>
                                        <textarea ng-disabled="!edit" ng-model="model.observation"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                             <div layout="row">
                                <div flex="45">
                                    <md-input-container class="md-block">
                                        <label>Calidad del servicio</label>
                                        <md-select ng-disabled="!edit"  placeholder="Calidad del servicio" ng-model="model.qualityOfService"  style="min-width: 200px;">
                                        <md-option ng-value="model.qualityOfService" ng-repeat="qualityOfService in config.qualityOfServices">{{qualityOfService}}</md-option>
                                    </md-input-container>
                                </div>
                                <div flex="45" flex-offset="10">
                                      <md-input-container  class="md-block">
                                        <label>Evaluacion</label>
                                        <textarea  ng-disabled="!edit" ng-model="model.evaluation"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                        </form>
                        <br/>
                            <md-divider class="teal"></md-divider>
                        <br/>
                        <div class="md-toolbar-tools">
                            <span>Solicitud asignada a </span>
                        </div>
                        <div layout="row">
                            <div flex="45">
                                <md-autocomplete ng-disabled="!edit" md-selected-item="model.userAssigned" md-min-length="0" placeholder="Selecione un usuario" md-search-text="searchText" md-items="user in getUsers(searchText)" md-item-text="user.showName">
                                  <span md-highlight-text="searchText">{{user.showName}}</span>
                                </md-autocomplete>
                            </div>
                        </div>
                   </md-card-content>
                   <md-card-actions layout="row" layout-align="end center">
                        <md-button ng-click="editMode()" ng-hide="edit || noUserInput()" class="md-primary md-raised">Editar</md-button>
                        <md-button ng-click="save()" ng-show="edit" class="md-primary">Guardar</md-button>
                        <md-button ng-click="viewMode()" ng-show="edit" class="md-primary md-raised">Cancelar</md-button>
                    </md-card-actions>
                </md-card>
                <br/>
            </md-content>
        </md-tab>
        <!--End of tabs Todos-->
        <!-- Load dynamic tabs -->
        <md-tab ng-repeat="(keyState, state) in states" label="{{state.name}}" md-on-select="clearModel()">
            <md-content class="md-padding">
                <!-- Table for dynamic tabs-->
                <md-card class="card-admin-ticket">
                    <md-card-tittle>
                    </md-card-tittle>
                    <md-card-content>
                        <md-toolbar class="md-table-toolbar md-default">
                          <div class="md-toolbar-tools">
                            <span>Tickets</span>
                          </div>
                        </md-toolbar>
                        <!-- exact table from live demo -->
                        <md-table-container>
                          <table md-table md-row-select ng-model="selected" md-progress="promise">
                            <thead md-head md-order="query.order">
                              <tr md-row>
                                <th md-column><span>Asunto</span></th>
                                <th md-column ><span>Descripcion</span></th>
                                <th md-column >Tipo</th>
                                <th md-column >Nivel</th>
                                <th md-column >Prioridad</th>
                                <th md-column >Tiempo de Respuesta</th>
                                <th md-column >Solicitante</th>
                              </tr>
                            </thead>
                            <tbody md-body>
                              <tr md-row md-select="ticket" md-on-select="selectItem" md-on-deselect="deselectItem" ng-repeat="ticket in state.table | limitTo: query.limit: (query.page - 1) * query.limit">
                                <td md-cell>{{ticket.subject}}</td>
                                <td md-cell>{{ticket.description}}</td>
                                <td md-cell>{{ticket.type}}</td>
                                <td md-cell>{{ticket.level}}</td>
                                <td md-cell>{{ticket.priority}}</td>
                                <td md-cell>{{ticket.answerTime}}</td>
                                <td md-cell>{{ticket.userReporter.name}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </md-table-container>
                        
                        <md-table-pagination md-limit="query.limit" md-limit-options="[5, 10, 15]" md-page="query.page" md-total="{{state.table.length}}" md-page-select></md-table-pagination>
                    </md-card-content>
                </md-card>
                <br/>
                <!-- Card for summary of tickets in other tabs -->
                <md-card ng-show="ticketSelected" class="card-admin-ticket">
                   <md-card-tittle></md-card-tittle> 
                   <md-card-content>
                        <div class="md-toolbar-tools">
                            <span>Descripcion del Ticket</span>
                          </div>
                        <form name="adminTicket">
                            <div layout="row">
                                <div flex="45">
                                    <md-input-container class="md-block">
                                        <label>Asunto</label>
                                        <textarea readonly ng-model="model.subject"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="45" flex-offset="10">
                                      <md-input-container  class="md-block">
                                        <label>Descripcion</label>
                                        <textarea  readonly ng-model="model.description"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                            <div layout="row">
                                <div flex="30">
                                    <md-input-container class="md-block">
                                        <label>Tipo</label>
                                        <textarea readonly ng-model="model.type"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container  class="md-block">
                                        <label>Nivel</label>
                                        <textarea readonly ng-model="model.level"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                      <md-input-container  class="md-block">
                                        <label>Prioridad</label>
                                         <textarea readonly ng-model="model.priority"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                            <div layout="row">
                                <div flex="30">
                                    <md-input-container class="md-block">
                                        <label>Usuario</label>
                                        <textarea readonly ng-model="model.userReporter.name"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container  class="md-block">
                                       <label>Departamento</label>
                                        <textarea readonly ng-model="model.department"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container  class="md-block">
                                         <label>Estado</label>
                                        <md-select ng-disabled="!edit"  placeholder="Estados" ng-model="model.state"  style="min-width: 200px;" >
                                        <md-option ng-value="state" ng-repeat="state in config.states">{{state}}</md-option>
                                    </md-input-container>
                                </div>
                            </div>
                            <div layout="row">
                                <div flex="30">
                                    <md-input-container class="md-block">
                                        <label>Fecha de creacion</label>
                                        <textarea readonly ng-model="model.submitDate"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container  class="md-block">
                                       <label>Tiempo de respuesta</label>
                                        <textarea readonly ng-model="model.answerTime"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container class="md-block">
                                        <label>Fecha de cierre</label>
                                        <textarea readonly ng-model="model.closeDate"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                            <div layout="row">
                                <div flex="45">
                                    <md-input-container class="md-block">
                                        <label>Descripcion de la solucion</label>
                                        <textarea ng-disabled="!edit" ng-model="model.solutionDescription"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="45" flex-offset="10">
                                      <md-input-container  class="md-block">
                                        <label>Observaciones</label>
                                        <textarea ng-disabled="!edit" ng-model="model.observation"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                            <div layout="row">
                                <div flex="45">
                                    <md-input-container class="md-block">
                                        <label>Calidad del servicio</label>
                                        <md-select ng-disabled="!edit"  placeholder="Calidad del servicio" ng-model="model.qualityOfService"  style="min-width: 200px;">
                                        <md-option ng-value="model.qualityOfService" ng-repeat="qualityOfService in config.qualityOfServices">{{qualityOfService}}</md-option>
                                    </md-input-container>
                                </div>
                                <div flex="45" flex-offset="10">
                                      <md-input-container  class="md-block">
                                        <label>Evaluacion</label>
                                        <textarea  ng-disabled="!edit" ng-model="model.evaluation"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                        </form>
                         <br/>
                            <md-divider class="teal"></md-divider>
                        <br/>
                        <div class="md-toolbar-tools">
                            <span>Solicitud asignada a </span>
                        </div>
                        <div layout="row">
                            <div flex="45">
                                <md-autocomplete  ng-disabled="!edit" md-selected-item="model.userAssigned" md-min-length="0" placeholder="Selecione un usuario" md-search-text="searchText" md-items="user in getUsers(searchText)" md-item-text="user.showName">
                                  <span md-highlight-text="searchText">{{user.showName}}</span>
                                </md-autocomplete>
                            </div>
                        </div>
                   </md-card-content>
                   <md-card-actions layout="row" layout-align="end center">
                        <md-button ng-click="editMode()" ng-hide="edit || noUserInput()" class="md-primary md-raised">Editar</md-button>
                        <md-button ng-click="save()" ng-show="edit" class="md-primary">Guardar</md-button>
                        <md-button ng-click="viewMode()" ng-show="edit" class="md-primary md-raised">Cancelar</md-button>
                    </md-card-actions>
                </md-card>
                
            </md-content>
        </md-tab>
        <!--End of dinamyc tabs -->
    </md-tabs>
  </md-content>
</div>
