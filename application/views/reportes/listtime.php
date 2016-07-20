<md-content ng-if="loading" class="md-padding">
    <div layout layout-align="center center">
        <md-progress-circular md-mode="indeterminate" md-diameter="80"></md-progress-circular>
    </div>
</md-content>

<div ng-cloak ng-if="!loading">
  <md-content id="mainContent">
    <br/>
        <!-- Load Table for tabs todos-->
    <p class="card-admin-ticket">
        En la siguiente tabla encontrará <b>todas</b> las solicitudes generadas.
        Seleccione alguna para consultar más detalles.
    </p>
    <md-card class="card-admin-ticket">
        <md-card-tittle>
        </md-card-tittle>
        <md-card-content>
          <div layout="row">
            <div flex="30">
                <input input-date type="text" id="inputCreated" placeholder="Fecha de inicio" ng-model="model.from" format="dd/mm/yyyy" months-full="{{ month }}" months-short="{{ monthShort }}" weekdays-full="{{ weekdaysFull }}"
                  weekdays-short="{{ weekdaysShort }}"
                  weekdays-letter="{{ weekdaysLetter }}"
                  min="{{ minDate }}"
                  max="{{ maxDate }}"
                  today="today"
                  clear="clear"
                  close="close"
                  select-years="15"
                  on-open="onOpenDatePicker()"
                  on-close="onCloseDatePicker()"
                />
            </div>
             <div flex="30" flex-offset="5" >
                <input input-date type="text" id="inputCreated" placeholder="Fecha de fin" ng-model="model.to" format="dd/mm/yyyy" months-full="{{ month }}" months-short="{{ monthShort }}" weekdays-full="{{ weekdaysFull }}"
                  weekdays-short="{{ weekdaysShort }}"
                  weekdays-letter="{{ weekdaysLetter }}"
                  min="{{ minDate }}"
                  max="{{ maxDate }}"
                  today="today"
                  clear="clear"
                  close="close"
                  select-years="15"
                  on-open="onOpenDatePicker()"
                  on-close="onCloseDatePicker()"
                />
              </div>
              <div flex="30" flex-offset="5" layout-align="center center">
                <md-button ng-click= "getTicketsForDate()" class="md-primary md-raised" >Consultar</md-button>
              </div>
            </div>
            <p>Solicitudes en espera</p>
              <div layout="row" >
                <div flex="40" flex-offset="35" >
                    {{enEspera}} / {{todas}} <span ng-show="result">({{(enEspera * 100) / todas | number:2}}%)</span>
                </div>
            </div>
            <div layout="row">
                <div flex="40" layout-align="center">
                    <md-progress-linear md-theme="{{badProgressTheme(enEspera * 100 / todas)}}" md-mode="determinate" value="{{(enEspera * 100) / todas}}" md-theme-watch></md-progress-linear>
                </div>
            </div>
            <br/>
             <p>Solicitudes atendias</p>
              <div layout="row" >
                <div flex="40" flex-offset="35" >
                    {{atendidas}} / {{todas}} <span ng-show="result">({{(atendidas * 100) / todas | number:2}}%)</span>
                </div>
            </div>
            <div layout="row">
                <div flex="40" layout-align="center">
                    <md-progress-linear md-theme="{{goodProgressTheme(atendidas * 100 / todas)}}" md-mode="determinate" value="{{(atendidas * 100) / todas}}" md-theme-watch></md-progress-linear>
                </div>
            </div>
            <br/>
             <p>Solicitudes que excedieron el tiempo de respuesta</p>
              <div layout="row" >
                <div flex="40" flex-offset="35" >
                    {{excedidas}} / {{todas}} <span ng-show="result">({{(excedidas * 100) / todas | number:2}}%)</span>
                </div>
            </div>
            <div layout="row">
                <div flex="40" layout-align="center">
                    <md-progress-linear  md-theme="{{badProgressTheme(excedidas * 100 / todas)}}"md-mode="determinate" value="{{(excedidas * 100) / todas}}" md-theme-watch></md-progress-linear>
                </div>
            </div>

            <br/>
            <br/>
            <md-toolbar ng-show="result" class="md-table-toolbar md-default">
              <div class="md-toolbar-tools">
                <span>Tickets</span>
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
                    <th md-column>Días restantes</th>
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
                    <td md-cell>{{ticket.daysLeft}} <md-icon ng-if="ticket.warn" ng-style="{'color':'#F44336'}">warning</md-icon></td>
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
                    <div flex="45">
                        <md-input-container class="md-block">
                            <label>Asunto</label>
                            <textarea readonly ng-model="model.subject"></textarea>
                        </md-input-container>
                    </div>
                    <div flex="45" flex-offset="10">
                          <md-input-container  class="md-block">
                            <label>Descripción</label>
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
                            <label>Fecha de creación</label>
                            <textarea readonly ng-model="model.submitDate"></textarea>
                        </md-input-container>
                    </div>
                    <div flex="30" flex-offset="5">
                        <md-input-container  class="md-block">
                           <label>Tiempo estimado de respuesta</label>
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
                            <label>Calidad del servicio</label>
                            <textarea readonly ng-model="model.qualityOfService"></textarea>
                        </md-input-container>
                    </div>
                    <div flex="45" flex-offset="10">
                          <md-input-container  class="md-block">
                            <label>Evaluación</label>
                            <textarea  readonly ng-model="model.evaluation"></textarea>
                        </md-input-container>
                    </div>
                </div>
                <div layout="row">
                    <div flex="45">
                        <md-input-container class="md-block">
                            <label>Descripción de la solución</label>
                            <textarea ng-disabled="!edit" ng-model="model.solutionDescription"></textarea>
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
                    <md-input-container class="md-block">
                        <label>Tecnico/Analista Asignado</label>
                        <textarea ng-disabled="!edit" ng-model="model.userAssigned.showName"></textarea>
                    </md-input-container>
                </div>
            </div>
       </md-card-content>

    </md-card>
    <br/>
  </md-content>
</div>
