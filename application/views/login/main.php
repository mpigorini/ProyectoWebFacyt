    	<div>
    	    <h5 class="center-align" style="font-weight:300">Sistema de reporte</h5>
    	    <h6 class="center-align">Inicia sesión para ingresar al sistema</h6>
    	</div>
		<div id="login-card" >
			<div class="container card" style ="width:100%">
				<br>
				<div class="row center">
				    <img id="login-img" class="responsive-img center " src="<?php echo base_url()?>images/icon-profile.png">
				</div>
				<div class="row" style="padding-bottom: 10px;">
          			<fom>
						<div class="col s6 offset-s3">
							<div class="input-field">
								<i class="material-icons prefix">account_circle</i>
						        <input id="username" name="username" type="text" class="validate" ng-model="model.login">
						        <label for="username">Usuario</label>
					        </div>
				        </div>
						<div class="col s6 offset-s3">
					        <div class="input-field">
								<i class="material-icons prefix">lock</i>
						        <input id="password" name="password" type="password" class="validate" ng-model="model.password">
						        <label for="password">Contraseña</label>
					        </div>
				        </div>
				        <div class="col s12 center red-text"  >
					      <span ng-bind="model.errorLogin" ng-show ="model.errorLogin != 'success'"></span>
				        </div>
				        <div class="row col s6 offset-s3 center">
					        <div class="preloader-wrapper active" ng-show="loading">
							    <div class="spinner-layer spinner-blue-only">
							      <div class="circle-clipper left">
							        <div class="circle"></div>
							      </div><div class="gap-patch">
							        <div class="circle"></div>
							      </div><div class="circle-clipper right">
							        <div class="circle"></div>
							      </div>
							    </div>
							</div>
						</div>	
				       	<a class="btn col s6 offset-s3 waves-effect waves-light center"  name="login" ng-click="login()">Iniciar sesión</a>
					</form>
		        </div>
			</div>
		</div>
