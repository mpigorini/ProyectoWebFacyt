    	<div style="cursor: default;">
    		<br><h4 ng-show="recovery.recoveryView" class="center-align" style="font-weight:300">Sistema de recuperación de contraseña</h4>
    	    <h5 ng-show="!recovery.recoveryView" class="center-align" style="font-weight:300">Sistema de reporte</h5>
    	    <br><h5 ng-show="recovery.recoveryView" class="center-align" style="margin-bottom: 110px;">Para cambiar tu contraseña, ingresa tu login y contesta la pregunta de seguridad...</h6>
    	    <h6 ng-show="!recovery.recoveryView" class="center-align">Inicia sesión para ingresar al sistema</h6>
    	</div>
		<div id="login-card">
			<div class="container card" style ="width:100%; margin-bottom: 70px;">
				<div ng-show="!recovery.recoveryView">
					<br>
					<div class="row center">
					    <img id="login-img" class="responsive-img center " src="<?php echo base_url()?>images/icon-profile.png">
					</div>
					<div class="row" style="padding-bottom: 10px;">
	          			<form>
							<div class="col s6 offset-s3">
								<div class="input-field">
									<i class="material-icons prefix">account_circle</i>
							        <input id="username" name="username" type="text" class="validate" ng-model="model.login" ng-keyup="$event.keyCode == 13 && login()">
							        <label for="username">Usuario</label>
						        </div>
					        </div>
							<div class="col s6 offset-s3">
						        <div class="input-field">
									<i class="material-icons prefix">lock</i>
							        <input id="password" name="password" type="password" class="validate" ng-model="model.password" ng-keyup="$event.keyCode == 13 && login()">
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
			        <h6 class="center-align"><a href="" ng-click="recoveryPass()">¿Haz olvidado tu contraseña?</a></h6><br><br>
				</div>
				<div ng-show="recovery.recoveryView">
					<div ng-show="!recovery.showQuestion && !recovery.showSetPass">
						<div class="row">
							<div class="input-field col s6 offset-s3">
				          		<input ng-model="recovery.recoveryLogin" id="recoveryLogin" type="text" class="validate" autocomplete="off">
				          		<label for="recoveryLogin">Login</label>
				        	</div>
						</div><br>
						<div class="row">
							<button class="btn col s3 offset-s3 waves-effect waves-light  yellow darken-4"  name="showQuestion" ng-click="showQuestion()" style="margin-bottom: 25px;">Mostrar pregunta</button>
							<button class="btn col s2 offset-s1 waves-effect waves-light  yellow darken-4"  name="showLogin" ng-click="showLogin()" style="margin-bottom: 25px;">Cancelar</button>
						</div>
					</div>
					<div ng-show="recovery.showQuestion"><br>
						<div class="row">
							<h3 class="center-align" style="cursor: default;">{{recovery.question}}</h3>
						</div><br>
						<div class="row">
							<div class="input-field col s6 offset-s3">
								<input style="font-size:20px;" id="recoveryAnswer" type="text" class="validate" ng-model="recovery.recoveryAnswer" autocomplete="off">
			          			<label style="font-size:20px;" for="recoveryAnswer">Ingresa tu respuesta...</label>
							</div>
						</div><br>
						<div class="row">
							<button class="btn col s2 offset-s3 waves-effect waves-light  yellow darken-4"  name="showSetPass" ng-click="showSetPass()" style="margin-bottom: 25px;">Continuar</button>
							<button class="btn col s2 offset-s2 waves-effect waves-light  yellow darken-4"  name="showLogin" ng-click="showLogin()" style="margin-bottom: 25px;">Cancelar</button>
						</div>
					</div><br>
					<div ng-show="recovery.showSetPass">
						<div class="row">
							<div class="input-field col s6 offset-s3">
								<input style="font-size:20px;" id="recoveryPassword" type="text" class="validate" ng-model="recovery.recoveryPassword" autocomplete="off">
				          		<label style="font-size:20px;" for="recoveryPassword">Ingresa tu nueva contraseña</label>
							</div>
						</div><br>
						<div class="row">
							<button class="btn col s2 offset-s3 waves-effect waves-light  yellow darken-4"  name="setPass" ng-click="setPass()" style="margin-bottom: 25px;">Guardar</button>
							<button class="btn col s2 offset-s2 waves-effect waves-light  yellow darken-4"  name="showLogin" ng-click="showLogin()" style="margin-bottom: 25px;">Cancelar</button>
						</div>
					</div>
				</div>
			</div>
		</div>