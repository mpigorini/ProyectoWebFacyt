<md-content ng-if="loading" class="md-padding">
    <div layout layout-align="center center">
        <md-progress-circular md-mode="indeterminate" md-diameter="80"></md-progress-circular>
    </div>
</md-content>

<div ng-cloak ng-if="!loading">
  <md-content>
    <md-tabs md-dynamic-height md-border-bottom md-stretch-tabs="always">
        <!-- Init tabs Todos -->
        <md-tab label="Todas" md-on-select="clearModel()">
            <md-content>
                <br/>
                <!-- HELP for tabs "todas" -->
                <md-card ng-show="$parent.helpers" class="card-admin-ticket" md-theme="blue-grey">
                    <md-card-title>
                        <div layout layout-align="center center">
                            <md-icon ng-style="{'color':'yellow'}">info_outline</md-icon>
                            <span ng-style="{'color':'white', 'margin-left':'10px'}">INFORMACIÓN</span>
                        </div>
                    </md-card-title>
                    <md-divider></md-divider>
                    <md-card-content>
                        <p ng-style="{'color':'white'}">
                            En la siguiente tabla se muestran <b>todos</b> los tickets que se le ha sido asignado. </br>
                            Al hacer click sobre una casilla correspondiente a algún ticket, se mostrarán sus detalles
                            y podrá, al final del panel de detalles, atender a dicha solicitud.
                        </p>
                    </md-card-content>
                </md-card>
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
                          <table md-table md-row-select ng-model="selected">
                            <thead md-head md-order="query.order">
                              <tr md-row>
                                <th md-column><span>ID</span></th>
                                <th md-column><span>Asunto</span></th>
                                <th md-column>Solicitante</th>
                                <th md-column>Días restantes</th>
                                <th md-column>Tipo</th>
                                <th md-column>Estado</th<>
                                <th md-column>Prioridad</th>
                              </tr>
                            </thead>
                            <tbody md-body>
                              <tr md-row md-select="ticket"  md-on-select="selectItem" md-on-deselect="deselectItem" ng-repeat="ticket in tickets | orderBy: ticket.subject | limitTo: query.limit: (query.page - 1) * query.limit">
                                <td md-cell>{{ticket.paddedId}}</td>
                                <td md-cell>{{ticket.subject}}</td>
                                <td md-cell>{{ticket.userReporter.name}}</td>
                                <td md-cell>{{ticket.daysLeft}} <md-icon ng-if="ticket.warn" ng-style="{'color':'#F44336'}">warning</md-icon></td>
                                <td md-cell>{{ticket.type}}</td>
                                <td md-cell>{{ticket.state}}</td>
                                <td md-cell>{{ticket.priority}}</td>
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
                   <md-card-content>
                        <div class="md-toolbar-tools">
                            <span>Detalles del Ticket #{{model.paddedId}}</span>
                        </div>
                        <form>
                            <div layout="row">
                                <div flex="30">
                                    <md-input-container class="md-block">
                                        <label>Asunto</label>
                                        <textarea readonly ng-model="model.subject"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                      <md-input-container  class="md-block">
                                        <label>Descripción</label>
                                        <textarea  readonly ng-model="model.description"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container class="md-block">
                                        <label>Tipo</label>
                                        <textarea readonly ng-model="model.type"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                            <div layout="row">
                                <div flex="30">
                                    <md-input-container  class="md-block">
                                        <label>Nivel</label>
                                        <textarea readonly ng-model="model.level"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container class="md-block">
                                        <label>Calidad del servicio</label>
                                        <textarea readonly ng-model="model.qualityOfService"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                      <md-input-container  class="md-block">
                                        <label>Evaluación</label>
                                        <textarea  readonly ng-model="model.evaluation"></textarea>
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
                                        <label>Prioridad</label>
                                         <textarea readonly ng-model="model.priority"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                             <div layout="row">
                                <div flex="30">
                                    <md-input-container class="md-block">
                                        <label>Fecha de creación</label>
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
                        </form>
                        <br/>
                            <md-divider class="teal"></md-divider>
                        <br/>
                        <div layout="row">
                            <div flex="45">
                                <md-input-container class="md-block">
                                    <label>Descripción de la solución</label>
                                    <textarea ng-disabled="!edit" ng-model="model.solutionDescription"></textarea>
                                </md-input-container>
                            </div>
                            <div flex="45" flex-offset="10">
                                  <md-input-container  class="md-block">
                                     <label>Estado</label>
                                    <md-select ng-disabled="!edit"  placeholder="Estados" ng-model="model.state"  style="min-width: 200px;">
                                    <md-option ng-value="state" ng-repeat="state in config.states">{{state}}</md-option>
                                </md-input-container>
                            </div>
                        </div>
                   </md-card-content>
                   <md-card-actions layout="row" layout-align="end center">
                        <md-button ng-click="editMode()" ng-hide="edit || noUserInput()" class="md-accent md-raised">Editar</md-button>
                        <md-button ng-click="save()" ng-show="edit" class="md-accent">Guardar</md-button>
                        <md-button ng-click="viewMode()" ng-show="edit" class="md-accent md-raised">Cancelar</md-button>
                    </md-card-actions>
                </md-card>
                <br/>
            </md-content>
        </md-tab>
        <!--End of tabs Todos-->
        <!-- Load dynamic tabs -->
        <md-tab ng-repeat="(keyState, state) in states" label="{{state.name}}" md-on-select="clearModel()">
            <!-- HELP for dynamic tabs -->
            <br/>
            <md-card ng-show="$parent.helpers" class="card-admin-ticket" md-theme="blue-grey">
                <md-card-title>
                    <div layout layout-align="center center">
                        <md-icon ng-style="{'color':'yellow'}">info_outline</md-icon>
                        <span ng-style="{'color':'white', 'margin-left':'10px'}">INFORMACIÓN</span>
                    </div>
                </md-card-title>
                <md-divider></md-divider>
                <md-card-content>
                    <p ng-style="{'color':'white'}">
                        En la siguiente tabla se muestran los tickets que se le ha sido asignado, actualmente en estado "{{state.name}}" </br>
                        Al hacer click sobre una casilla correspondiente a algún ticket, se mostrarán sus detalles
                        y podrá, al final del panel de detalles, atender a dicha solicitud.
                    </p>
                </md-card-content>
            </md-card>
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
                          <table md-table md-row-select ng-model="selected">
                            <thead md-head md-order="query.order">
                              <tr md-row>
                                <th md-column><span>ID</span></th>
                                <th md-column><span>Asunto</span></th>
                                <th md-column >Solicitante</th>
                                <th md-column >Días restantes</th>
                                <th md-column >Tipo</th>
                                <th md-column >Prioridad</th>
                              </tr>
                            </thead>
                            <tbody md-body>
                              <tr md-row md-select="ticket" md-on-select="selectItem" md-on-deselect="deselectItem" ng-repeat="ticket in state.table | limitTo: query.limit: (query.page - 1) * query.limit">
                                <td md-cell>{{ticket.paddedId}}</td>
                                <td md-cell>{{ticket.subject}}</td>
                                <td md-cell>{{ticket.userReporter.name}}</td>
                                <td md-cell>{{ticket.daysLeft}} <md-icon ng-if="ticket.warn" ng-style="{'color':'#F44336'}">warning</md-icon></td>
                                <td md-cell>{{ticket.type}}</td>
                                <td md-cell>{{ticket.priority}}</td>
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
                            <span>Detalles del Ticket #{{model.paddedId}}</span>
                        </div>
                        <form name="adminTicket">
                            <div layout="row">
                                <div flex="30">
                                    <md-input-container class="md-block">
                                        <label>Asunto</label>
                                        <textarea readonly ng-model="model.subject"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                      <md-input-container  class="md-block">
                                        <label>Descripción</label>
                                        <textarea  readonly ng-model="model.description"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container class="md-block">
                                        <label>Tipo</label>
                                        <textarea readonly ng-model="model.type"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                            <div layout="row">
                                <div flex="30">
                                    <md-input-container  class="md-block">
                                        <label>Nivel</label>
                                        <textarea readonly ng-model="model.level"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container class="md-block">
                                        <label>Calidad del servicio</label>
                                        <textarea readonly ng-model="model.qualityOfService"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                      <md-input-container  class="md-block">
                                        <label>Evaluación</label>
                                        <textarea  readonly ng-model="model.evaluation"></textarea>
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
                                        <label>Prioridad</label>
                                         <textarea readonly ng-model="model.priority"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                             <div layout="row">
                                <div flex="30">
                                    <md-input-container class="md-block">
                                        <label>Fecha de creación</label>
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
                        </form>
                        <br/>
                            <md-divider class="teal"></md-divider>
                        <br/>
                        <div layout="row">
                            <div flex="45">
                                <md-input-container class="md-block">
                                    <label>Descripción de la solución</label>
                                    <textarea ng-disabled="!edit" ng-model="model.solutionDescription"></textarea>
                                </md-input-container>
                            </div>
                            <div flex="45" flex-offset="10">
                                  <md-input-container  class="md-block">
                                     <label>Estado</label>
                                    <md-select ng-disabled="!edit"  placeholder="Estados" ng-model="model.state"  style="min-width: 200px;">
                                    <md-option ng-value="state" ng-repeat="state in config.states">{{state}}</md-option>
                                </md-input-container>
                            </div>
                        </div>
                   </md-card-content>
                   <md-card-actions layout="row" layout-align="end center">
                        <md-button ng-click="editMode()" ng-hide="edit || noUserInput()" class="md-accent md-raised">Editar</md-button>
                        <md-button ng-click="save()" ng-show="edit" class="md-accent">Guardar</md-button>
                        <md-button ng-click="viewMode()" ng-show="edit" class="md-accent md-raised">Cancelar</md-button>
                    </md-card-actions>
                </md-card>

            </md-content>
        </md-tab>
        <!--End of dinamyc tabs -->
    </md-tabs>
  </md-content>
</div>
