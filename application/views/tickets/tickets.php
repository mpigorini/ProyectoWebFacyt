<div ng-controller="ListTicketController">
    <div class="col s12 z-depth-1">
      <ul class="tabs #00bfa5 teal-text accent-4" >
        <li class="tab col s3"><a class="#00bfa5 teal-text accent-4" href="#todos">Todos</a></li>
        <?php
            foreach ($state as $key => $value) {
              echo '<li class="tab col s3"><a class="#00bfa5 teal-text accent-4" href="#'.$value.'">'.$value.'</a></li>';
            }
         ?>
        <div class="indicator teal accent-4" style="z-index:1"></div>
      </ul>
    </div>
    <div >
      <?php

          foreach ($state as $key => $value) {
            echo '<div id="'.$value.'" class="col s12">
                  <div class="row">
                  <div class="col s12 m12">
                  <div class="card ">
                  <div class="card-content">
                  <span class="card-title">Tickets: '.$value.'</span>
                  <table class="bordered highlight"> <tr><th>Subject</th>
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
                  </tr>';
            echo  "<tr ng-repeat='x in list | filter:{state:\"";
            echo  $value;
            echo  "\"}'>";
            echo  "<td>{{x.subject}}</td>
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
                </div>";
          }
       ?>
      <div id="todos" class="col s12">
        <div class="row">
          <div class="col s12 m12">
            <div class="card ">
              <div class="card-content">
                <span class="card-title">Todos los tickets</span>
                  <table class="bordered highlight">
                    <tr >
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
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('ul.tabs').tabs();

  });
</script>
