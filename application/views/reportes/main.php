
<div class="" ng-controller="MainCtrl">
 
 // este hace lo mismo de tickets me imagino que no se usaria 
  <div class="row">
  <h2>List Tickets</h2>
        <div>
         <input  ng-model="search" class="col s3 offset-s4" type="text"><i class="material-icons ">search</i></a></li>
        </div>
          <table class="highlight table-responsive ">
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
                    <tr ng-repeat="ticket in lists | filter: search ">
                      <td>{{ticket.subject}}</td>
                      <td>{{ticket.description}}</td>
                      <td>{{ticket.type}}</td>
                      <td>{{ticket.level}}</td>
                      <td>{{ticket.priority}}</td>
                      <td>{{ticket.answerTime}}</td>
                      <td>{{ticket.qualityOfService}}</td>
                      <td>{{ticket.userReporter}}</td>
                      <td>{{ticket.departament}}</td>
                      <td >{{ticket.submitDate}}</td>
                      <td >{{ticket.closeDate}}</td>
                      <td>{{ticket.state}}</td>
                      <td>{{ticket.solutionDescription}}</td>
                      <td>{{ticket.evaluation}}</td>
                      <td>{{ticket.observations}}</td>
                    </tr>
          </table>
     </div>
</div>