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
            <md-content class="md-padding">
                <br/>
                <!-- HELP for tab "todas" -->
                <md-card class="card-admin-ticket" md-theme="dark-orange">
                    <md-card-title>
                        <md-card-title-media>
                            <div class="md-media-md"><img  ng-src="{{helpImagePath}}" class="md-card-image" alt="Help"></div>
                        </md-card-title-media>
                        <md-card-content>
                            <p ng-style="{'color':'white'}">
                                En la siguiente tabla encontrará <b>todas</b> las solicitudes generadas por usted.</br>
                                Al hacer click sobre una casilla correspondiente a algún ticket, se mostrarán sus detalles
                                y podrá, al final del panel de detalles, realizar evaluaciones a dicha solicitud.
                            </p>
                        </md-card-content>
                    </md-card-title>
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
                                <th md-column ><span>Estado</span></th>
                                <th md-column >Tipo</th>
                                <th md-column >Prioridad</th>
                              </tr>
                            </thead>
                            <tbody md-body>
                              <tr md-row md-select="ticket"  md-on-select="selectItem" md-on-deselect="deselectItem" ng-repeat="ticket in tickets | orderBy: ticket.subject | limitTo: query.limit: (query.page - 1) * query.limit">
                                <td md-cell>{{ticket.paddedId}}</td>
                                <td md-cell>{{ticket.subject}}</td>
                                <td md-cell>{{ticket.state}}</td>
                                <td md-cell>{{ticket.type}}</td>
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
                   <md-card-tittle></md-card-tittle>
                   <md-card-content>
                        <div class="md-toolbar-tools">
                            <span>Detalles de interés del Ticket #{{model.paddedId}}</span>
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
                                      <md-input-container  class="md-block">
                                        <label>Técnico asignado</label>
                                        <textarea  readonly ng-model="model.userAssigned"></textarea>
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
                                     <md-input-container  class="md-block">
                                        <label>Departamento</label>
                                         <textarea readonly ng-model="model.department"></textarea>
                                     </md-input-container>
                                 </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container class="md-block">
                                        <label>Fecha de creación</label>
                                        <textarea readonly ng-model="model.submitDate"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container class="md-block">
                                        <label>Fecha de cierre</label>
                                        <textarea readonly ng-model="model.closeDate"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                            <div layout="row" layout-align="center center">
                                <div flex="30">
                                    <md-input-container  class="md-block">
                                       <label>Tiempo de respuesta</label>
                                        <textarea readonly ng-model="model.answerTime"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                      <md-input-container  class="md-block">
                                         <label>Estado</label>
                                        <textarea readonly ng-model="model.state"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="30" flex-offset="5">
                                    <md-input-container class="md-block">
                                        <label>Descripción de la solución</label>
                                        <textarea readonly ng-model="model.solutionDescription"></textarea>
                                    </md-input-container>
                                </div>
                            </div>
                        </form>
                   </md-card-content>
                </md-card>
                <!-- Rate our service! -->
                <br/>
                <md-card ng-show="ticketSelected" class="card-admin-ticket">
                    <md-card-content>
                        <div class="md-toolbar-tools">
                            <span>¡Realice su evaluación!</span>
                        </div>
                        <form>
                            <div layout>
                                <div flex="45">
                                    <md-input-container  class="md-block">
                                        <label>Evaluación</label>
                                        <textarea ng-disabled="!edit" ng-model="model.evaluation"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="45" flex-offset="10">
                                    <md-input-container ng-disabled="!edit"  class="md-block">
                                        <label>Calidad del servicio</label>
                                        <md-select ng-disabled="!edit" ng-model="model.qualityOfService">
                                            <md-option ng-value="qos" ng-repeat="qos in qualityOfServices">{{qos}}</md-option>
                                        </md-select>
                                    </md-input-container>
                                </div>
                            </div>
                        </form>
                    </md-card-content>
                    <md-card-actions layout="row" layout-align="end center">
                         <md-button ng-click="editMode()" ng-hide="edit || noUserInput()" class="md-primary md-raised">Editar</md-button>
                         <md-button ng-click="save()" ng-show="edit" class="md-primary">Enviar</md-button>
                         <md-button ng-click="viewMode()" ng-show="edit" class="md-primary md-raised">Cancelar</md-button>
                     </md-card-actions>
                </md-card>
            </md-content>
        </md-tab>
        <!--End of tabs Todos-->
        <!-- Load dynamic tabs -->
        <md-tab ng-repeat="(keyState, state) in states" label="{{state.name}}" md-on-select="clearModel()">
            <md-content class="md-padding">
                <br/>
                <!-- Help for dynamic tabs -->
                <md-card class="card-admin-ticket" md-theme="dark-orange">
                    <md-card-title>
                        <md-card-title-media>
                            <div class="md-media-md"><img  ng-src="{{helpImagePath}}" class="md-card-image" alt="Help"></div>
                        </md-card-title-media>
                        <md-card-content>
                            <p ng-style="{'color':'white'}">
                                En la siguiente tabla encontrará las solicitudes generadas por usted, actualmente en estado "{{state.name}}".</br>
                                Al hacer click sobre una casilla correspondiente a algún ticket, se mostrarán sus detalles
                                y podrá, al final del panel de detalles, realizar evaluaciones a dicha solicitud.
                            </p>
                        </md-card-content>
                    </md-card-title>
                </md-card>
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
                        <md-table-container>
                          <table md-table md-row-select ng-model="selected" >
                            <thead md-head md-order="query.order">
                              <tr md-row>
                                <th md-column><span>ID</span></th>
                                <th md-column><span>Asunto</span></th>
                                <th md-column ><span>Descripción</span></th>
                                <th md-column >Tipo</th>
                                <th md-column >Nivel</th>
                                <th md-column >Prioridad</th>
                                <th md-column >Tiempo de Respuesta</th>
                              </tr>
                            </thead>
                            <tbody md-body>
                            <tr md-row md-select="ticket" md-on-select="selectItem" md-on-deselect="deselectItem" ng-repeat="ticket in state.table | limitTo: query.limit: (query.page - 1) * query.limit">
                                <td md-cell>{{ticket.paddedId}}</td>
                                <td md-cell>{{ticket.subject}}</td>
                                <td md-cell>{{ticket.description}}</td>
                                <td md-cell>{{ticket.type}}</td>
                                <td md-cell>{{ticket.level}}</td>
                                <td md-cell>{{ticket.priority}}</td>
                                <td md-cell>{{ticket.answerTime}}</td>
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
                            <span>Descripción del Ticket #{{model.paddedId}}</span>
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
                                    <md-input-container  class="md-block">
                                      <label>Técnico asignado</label>
                                      <textarea  readonly ng-model="model.userAssigned"></textarea>
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
                                   <md-input-container  class="md-block">
                                      <label>Departamento</label>
                                       <textarea readonly ng-model="model.department"></textarea>
                                   </md-input-container>
                               </div>
                              <div flex="30" flex-offset="5">
                                  <md-input-container class="md-block">
                                      <label>Fecha de creación</label>
                                      <textarea readonly ng-model="model.submitDate"></textarea>
                                  </md-input-container>
                              </div>
                              <div flex="30" flex-offset="5">
                                  <md-input-container class="md-block">
                                      <label>Fecha de cierre</label>
                                      <textarea readonly ng-model="model.closeDate"></textarea>
                                  </md-input-container>
                              </div>
                          </div>
                          <div layout="row" layout-align="center center">
                              <div flex="30">
                                  <md-input-container  class="md-block">
                                     <label>Tiempo de respuesta</label>
                                      <textarea readonly ng-model="model.answerTime"></textarea>
                                  </md-input-container>
                              </div>
                              <div flex="30" flex-offset="5">
                                    <md-input-container  class="md-block">
                                       <label>Estado</label>
                                      <textarea readonly ng-model="model.state"></textarea>
                                  </md-input-container>
                              </div>
                              <div flex="30" flex-offset="5">
                                  <md-input-container class="md-block">
                                      <label>Descripción de la solución</label>
                                      <textarea readonly ng-model="model.solutionDescription"></textarea>
                                  </md-input-container>
                              </div>
                          </div>
                      </form>
                   </md-card-content>
                </md-card>
                <br/>
                <!-- Rate our service! -->
                <md-card ng-show="ticketSelected" class="card-admin-ticket">
                    <md-card-content>
                        <div class="md-toolbar-tools">
                            <span>¡Realice su evaluación!</span>
                        </div>
                        <form>
                            <div layout>
                                <div flex="45">
                                    <md-input-container  class="md-block">
                                        <label>Evaluación</label>
                                        <textarea ng-disabled="!edit" ng-model="model.evaluation"></textarea>
                                    </md-input-container>
                                </div>
                                <div flex="45" flex-offset="10">
                                    <md-input-container  class="md-block">
                                        <label>Calidad del servicio</label>
                                        <md-select ng-disabled="!edit" ng-model="model.qualityOfService">
                                            <md-option ng-value="qos" ng-repeat="qos in qualityOfServices">{{qos}}</md-option>
                                        </md-select>
                                    </md-input-container>
                                </div>
                            </div>
                        </form>
                    </md-card-content>
                    <md-card-actions layout="row" layout-align="end center">
                         <md-button ng-click="editMode()" ng-hide="edit || noUserInput()" class="md-primary md-raised">Editar</md-button>
                         <md-button ng-click="save()" ng-show="edit" class="md-primary">Enviar</md-button>
                         <md-button ng-click="viewMode()" ng-show="edit" class="md-primary md-raised">Cancelar</md-button>
                     </md-card-actions>
                </md-card>
            </md-content>
        </md-tab>
        <!--End of dinamyc tabs -->
    </md-tabs>
  </md-content>
</div>
