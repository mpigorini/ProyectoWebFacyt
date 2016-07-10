<div ng-controller="ListTicketController">
    <div class="z-depth-1">
      <ul class="tabs" >
        <li class="tab"><a href="#todos">Todos</a></li>
        <li class="tab"><a href="#espera">En Espera</a></li>
        <li class="tab"><a href="#proceso">En Proceso</a></li>
        <li class="tab"><a href="#atendido">Atendido</a></li>
      </ul>
    </div>
    <div >
      <div id="todos" class="col s12">
        <h5>Todos</h5>
        <div class="row">
          <div class="col s12 m12">
            <div class="card ">
              <div class="card-content">
                <span class="card-title">Tickets</span>
                  <table class="bordered highlight">
                    <tr>
                      <th>Subject</th>
                      <th>Description</th>
                      <th>Type</th>
                      <th>Level</th>
                      <th>Priority</th>
                      <th>Answer Time</th>
                      <th>Quality Of Service</th>
                      <th>User Reporter</th>
                      <th>Departament</th>
                      <th>Submit Date</th>
                      <th>Close Date</th>
                      <th>State</th>
                      <th>Solution Description</th>
                      <th>Evaluation</th>
                      <th>Observations</th>
                    </tr>
                    <tr ng-repeat="x in list">
                      <td>{{x.subject}}</td>
                      <td>{{x.description}}</td>
                      <td>{{x.type}}</td>
                      <td>{{x.level}}</td>
                      <td>{{x.priority}}</td>
                      <td>{{x.answerTime}}</td>
                      <td>{{x.qualityOfService}}</td>
                      <td>{{x.userReporter}}</td>
                      <td>{{x.departament}}</td>
                      <td >{{x.submitDate}}</td>
                      <td >{{x.closeDate}}</td>
                      <td>{{x.state}}</td>
                      <td>{{x.solutionDescription}}</td>
                      <td>{{x.evaluation}}</td>
                      <td>{{x.observations}}</td>
                    </tr>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div id="espera" class="col s12">
        <h5>En espera</h5>
        <div class="row">
          <div class="col s12 m12">
            <div class="card ">
              <div class="card-content">
                <span class="card-title">Tickets</span>
                <table class="bordered highlight">
                  <tr>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Level</th>
                    <th>Priority</th>
                    <th>Answer Time</th>
                    <th>Quality Of Service</th>
                    <th>User Reporter</th>
                    <th>Departament</th>
                    <th>Submit Date</th>
                    <th>Close Date</th>
                    <th>State</th>
                    <th>Solution Description</th>
                    <th>Evaluation</th>
                    <th>Observations</th>
                  </tr>
                  <tr ng-repeat="x in list | filter:{state:'espera'}">
                    <td>{{x.subject}}</td>
                    <td>{{x.description}}</td>
                    <td>{{x.type}}</td>
                    <td>{{x.level}}</td>
                    <td>{{x.priority}}</td>
                    <td>{{x.answerTime}}</td>
                    <td>{{x.qualityOfService}}</td>
                    <td>{{x.userReporter}}</td>
                    <td>{{x.departament}}</td>
                    <td >{{x.submitDate}}</td>
                    <td >{{x.closeDate}}</td>
                    <td>{{x.state}}</td>
                    <td>{{x.solutionDescription}}</td>
                    <td>{{x.evaluation}}</td>
                    <td>{{x.observations}}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="proceso" class="col s12">
        <h5>En proceso</h5>
        <div class="row">
          <div class="col s12 m12">
            <div class="card ">
              <div class="card-content">
                <span class="card-title">Tickets</span>
                <table class="bordered highlight">
                  <tr>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Level</th>
                    <th>Priority</th>
                    <th>Answer Time</th>
                    <th>Quality Of Service</th>
                    <th>User Reporter</th>
                    <th>Departament</th>
                    <th>Submit Date</th>
                    <th>Close Date</th>
                    <th>State</th>
                    <th>Solution Description</th>
                    <th>Evaluation</th>
                    <th>Observations</th>
                  </tr>
                  <tr ng-repeat="x in list | filter:{state:'proceso'}">
                    <td>{{x.subject}}</td>
                    <td>{{x.description}}</td>
                    <td>{{x.type}}</td>
                    <td>{{x.level}}</td>
                    <td>{{x.priority}}</td>
                    <td>{{x.answerTime}}</td>
                    <td>{{x.qualityOfService}}</td>
                    <td>{{x.userReporter}}</td>
                    <td>{{x.departament}}</td>
                    <td >{{x.submitDate}}</td>
                    <td >{{x.closeDate}}</td>
                    <td>{{x.state}}</td>
                    <td>{{x.solutionDescription}}</td>
                    <td>{{x.evaluation}}</td>
                    <td>{{x.observations}}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="atendido" class="col s12">
        <h5>Atendido</h5>
        <div class="row">
          <div class="col s12 m12">
            <div class="card ">
              <div class="card-content">
                <span class="card-title">Tickets</span>
                <table class="bordered highlight">
                  <tr>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Level</th>
                    <th>Priority</th>
                    <th>Answer Time</th>
                    <th>Quality Of Service</th>
                    <th>User Reporter</th>
                    <th>Departament</th>
                    <th>Submit Date</th>
                    <th>Close Date</th>
                    <th>State</th>
                    <th>Solution Description</th>
                    <th>Evaluation</th>
                    <th>Observations</th>
                  </tr>
                  <tr ng-repeat="x in list | filter:{state:'atendido'}">
                    <td>{{x.subject}}</td>
                    <td>{{x.description}}</td>
                    <td>{{x.type}}</td>
                    <td>{{x.level}}</td>
                    <td>{{x.priority}}</td>
                    <td>{{x.answerTime}}</td>
                    <td>{{x.qualityOfService}}</td>
                    <td>{{x.userReporter}}</td>
                    <td>{{x.departament}}</td>
                    <td >{{x.submitDate}}</td>
                    <td >{{x.closeDate}}</td>
                    <td>{{x.state}}</td>
                    <td>{{x.solutionDescription}}</td>
                    <td>{{x.evaluation}}</td>
                    <td>{{x.observations}}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('ul.tabs').tabs();
  });
</script>
