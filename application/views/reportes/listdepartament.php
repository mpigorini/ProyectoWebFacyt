<div ng-cloak>
  <md-content id="mainContent">
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
                      Selccione un <b>departamento</b> para ver todos los tickets correspondientes al departamento seleccionado.</br>
                      Al hacer click sobre una casilla correspondiente a algún ticket, se mostrarán sus detalles.
                  </p>
              </md-card-content>
    </md-card>
    <md-card class="card-admin-ticket">
        <md-card-tittle>
        </md-card-tittle>
        <md-card-content>
          <div layout layout-align="center">
            <div>
               <md-input-container  class="md-block">
                    <label>Departamento</label>
                    <md-select placeholder="Departamento" ng-model="model.departmentSelect" ng-change="getTicketsForDepartment()" style="min-width: 200px;">
                      <md-option ng-value="departmentSelect" ng-repeat="departmentSelect in departments">{{departmentSelect.name}}</md-option>
                    </md-select>
                </md-input-container>
            </div>
          </div>
          <br/>
            <h3 ng-show="noData">No se encontraron tickets asociados al departamento {{model.departmentSelect.name}}</h3>
            <md-toolbar ng-show="result" class="md-table-toolbar md-default">
              <div class="md-toolbar-tools">
                <span>Tickets del departamento {{model.departmentSelect.name}}</span>
              </div>
            </md-toolbar>
            <md-table-container ng-show="result">
              <table md-table md-row-select ng-model="selected">
                <thead md-head md-order="query.order">
                  <tr md-row>
                    <th md-column><span>ID</span></th>
                    <th md-column><span>Asunto</span></th>
                    <th md-column><span>Descripción</span></th>
                    <th md-column>Solicitante</th>
                    <th md-column>Prioridad</th>
                    <th md-column>Tipo</th>
                    <th md-column>Estado</th>
                  </tr>
                </thead>
                <tbody md-body>
                  <tr md-row md-select="ticket"  md-on-select="selectItem" md-on-deselect="deselectItem" ng-repeat="ticket in tickets | orderBy: ticket.subject | limitTo: query.limit: (query.page - 1) * query.limit">
                    <td md-cell>{{ticket.paddedId}}</td>
                    <td md-cell>{{ticket.subject}}</td>
                    <td md-cell>{{ticket.description}}</td>
                    <td md-cell>{{ticket.userReporter.name}}</td>
                    <td md-cell>{{ticket.priority}}</td>
                    <td md-cell>{{ticket.type}}</td>
                    <td md-cell>{{ticket.state}}</td>
                  </tr>
                </tbody>
              </table>
            </md-table-container>

            <md-table-pagination ng-show="result" md-limit="query.limit" md-limit-options="[5, 10, 15]" md-page="query.page" md-total="{{tickets.length}}" md-page-select></md-table-pagination>
        </md-card-content>
    </md-card>
    <br/>
    <!-- Load summary for tabs Todos-->
    <md-card ng-show="ticketSelected" class="card-admin-ticket">
       <md-card-tittle></md-card-tittle>
       <md-card-content>
            <div class="md-toolbar-tools">
                <span>Descripción del Ticket #{{model.paddedId}}</span>
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
                            <label>Tecnico/Analista Asignado</label>
                            <textarea readonly ng-model="model.userAssigned.showName"></textarea>
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
                            <textarea readonly ng-model="model.state"></textarea>
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
                 <div layout="row">
                    <div flex="30">
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
                    <div flex="30" flex-offset="5">
                        <md-input-container class="md-block">
                            <label>Descripción de la solución</label>
                            <textarea readonly ng-model="model.solutionDescription"></textarea>
                        </md-input-container>
                    </div>
                </div>
            </form>
            <br/>
       </md-card-content>

    </md-card>
    <br/>
  </md-content>
</div>
