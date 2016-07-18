
<div class="" >
 
  
  <div class="row">
  <h2>List Tickets</h2>
        <div>
         <input  ng-model="search" class="col s3 offset-s4" type="text"><i class="material-icons ">search</i></a></li>
        </div>
          <table class="highlight table-responsive ">
                    <tr>
                      <th>ID</th>
                      <th>Subject</th>
                      <th>Description</th>
                      <th>Type</th>
                      <th>Level</th>
                      <th>Priority</th>
                      <th>AnswerTime</th>
                      <th>Service</th>
                      <th>User Reporter</th>
                      <th>User Asig</th>
                      <th>Departament</th>
                      <th>Submit</th>
                      <th>Close</th>
                      <th>State</th>
                      <th>Solution</th>
                      <th>Evaluation</th>
                      
                    </tr>
                    <tr ng-repeat="ticket in lists | filter: search ">
                      <td>{{ticket.id}}</td>
                      <td>{{ticket.subject}}</td>
                      <td>{{ticket.description}}</td>
                      <td>{{ticket.type}}</td>
                      <td>{{ticket.level}}</td>
                      <td>{{ticket.priority}}</td>
                      <td>{{ticket.answerTime}}</td>
                      <td>{{ticket.qualityOfService}}</td>
                      <td>{{ticket.userReporter}}</td>
                      <td>{{ticket.userAssigned}}</td>
                      <td>{{ticket.department}}</td>
                      <td>{{ticket.submitDate}}</td>
                      <td>{{ticket.closeDate}}</td>
                      <td>{{ticket.state}}</td>
                      <td>{{ticket.solutionDescription}}</td>
                      <td>{{ticket.evaluation}}</td>
                    </tr>
          </table>
     </div>
</div>