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
                    console.log(response);
                    if(response.data.message === "success") {
                        var timeToExpire =  new Date();
                        timeToExpire.setDate(timeToExpire.getDate() + 7 );
                         //creamos la cookie
                        $cookies.putObject('session', {username: username , password:password, id:response.data.id}, {
                            expires : timeToExpire
                        });
                        //mandamos a la home
                        $location.path("/home");
                        
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
                $location.path("/home");
            }
        },
        isLoggedIn : function() 
        {
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