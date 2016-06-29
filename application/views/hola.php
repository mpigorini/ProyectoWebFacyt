
<body>
    
    <div><h1>HOLAAAAAAAAAAA</h1></div>
<?php
 include (APPPATH. '/libraries/ChromePhp.php');

    \ChromePhp::log($this->doctrine->em);
?>
    
    <div class="row">
        <form class="col s12">
            <div class="row">
                <div class="input-field col s6">
                  <input  id="login" type="text" class="validate" ng-model="model.login">
                  <label for="login">Login</label>
                </div>
                <div class="input-field col s6">
                  <input id="password" type="password" class="validate" ng-model="model.password">
                  <label for="password">password</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                  <input placeholder="Placeholder" id="first_name" type="text" class="validate" ng-model="model.name">
                  <label for="first_name">First Name</label>
                </div>
                <div class="input-field col s6">
                  <input id="last_name" type="text" class="validate" ng-model="model.lastName">
                  <label for="last_name">Last Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                  <input placeholder="Placeholder" id="type" type="text" class="validate" ng-model="model.type">
                  <label for="type">Tipo</label>
                </div>
            </div>
        </form>
        <a class="btn waves-effect waves-light" ng-click="save(this)" >Controller</a>    
    </div>
</body>

<script>
    $(document).ready(function() {
    Materialize.updateTextFields();
  });
</script>