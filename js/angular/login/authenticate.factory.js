//factoria que controla la autentificación, devuelve un objeto
//$cookies para crear cookies
//$cookieStore para actualizar o eliminar
//$location para cargar otras rutas
angular.module('helpDesk.login').factory("auth", function($cookies,$location, $http , $rootScope)
{
    return{
        login : function(username, password)
        {
            $http.get('index.php/login/LoginController/authenticate', {params:{username: username , password:password}})
                .then(function(response) {
                    console.log("response: " + response);
                    if(response.data.message === "success") {
                        var timeToExpire =  new Date();
                        timeToExpire.setDate(timeToExpire.getDate() + 7 );
                         //creamos la cookie
                        $cookies.putObject('session', {username: username , password:password, id:response.data.id,perfil:response.data.type}, {
                            expires : timeToExpire
                        });
                        //mandamos a la home
                        $location.path("/tickets");

                    }
                    var obj = $cookies.getObject("session");
                    console.log(obj);
                   $rootScope.model.errorLogin =  response.data.message;
                   $rootScope.loading=false;
                }, function (response){

            })

        },
        logout : function()
        {
            //al hacer logout eliminamos la cookie
            $cookies.remove('session');
            //cerramos automáticamente el mobile sideNav
            $('.button-collapse').sideNav('hide');
            //mandamos al login
            $location.path("/login");
        },
        checkStatus : function()
        {
            //creamos un array con las rutas que queremos controlar
            var rutasPrivadas = ["/home","/dashboard","/login"];
            if(this.in_array($location.path(),rutasPrivadas) && typeof($cookies.username) == "undefined")
            {
                $location.path("/login");
            }
            //en el caso de que intente acceder al login y ya haya iniciado sesión lo mandamos a la home
            if(this.in_array("/login",rutasPrivadas) && typeof($cookies.username) != "undefined")
            {
                //HOLA
                console.log("holaaaaaaaa");
                //$location.path("/tickets");
            }
        },
        perfil: function(){
          if($cookies.get('session') !== "undefined")
          {
            var obj = $cookies.getObject("session");
            return(obj.perfil);
          }
        },
        isLoggedIn : function()
        {
            //console.log($cookies.get('session'));
            return typeof $cookies.get('session') !== "undefined" ;
        },
        in_array : function(needle, haystack)
        {
            var key = '';
            for(key in haystack)
            {
                if(haystack[key] == needle)
                {
                    return true;
                }
            }
            return false;
        }

    }
});
