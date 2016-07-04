<div id="profile-card" class="container card">
    <div class="row">
        <div class="card left">
            <img src="<?php echo base_url()?>images/icon-profile.png"/>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <span class="col s6">Login</span>
            <input type="text" ng-show="view='edit'" ng-model="model.login">
            <span ng-bind="model.login" ng-model="model.login" ng-show="view=show"></span>
        </div>
    </div>

</div>
