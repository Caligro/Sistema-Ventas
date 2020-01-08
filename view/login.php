<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/styleLogin.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
	<img class="wave" src="../assets/img/w.png">
	<div class="container">
		<div class="img">
			<img src="../assets/img/bg.svg">
		</div>
		<div class="login-content">
			<form action="index.html">
				<img src="../assets/img/avatar.svg">
				<h2 class="title">Bienvenido</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Usuario</h5>
           		   		<input id="username" type="text" class="input"  >
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Contraseña</h5>
           		    	<input id="password" type="password" class="input" >
            	   </div>
            	</div>
            	<button id="btninicio" type="reset" class="btn" onclick="login()">Iniciar Sesión</button>
            </form>
        </div>
    </div>
	  <script src=""></script>
	  
	<!-- jQuery 3 -->
	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
	<!-- jQuery Login -->
	<script type="text/javascript" src="../assets/js/mainLogin.js"></script>
	<!-- jQuery Login -->
	<script type="text/javascript">
	   var txtUsuario= document.getElementById('username');
		var txtContra= document.getElementById('password');

    function login(){
		var param_opcion = 'login';
	
    $.ajax({
        type: 'POST',
		data: 'param_opcion='+param_opcion+
			'&param_usuario=' + txtUsuario.value+
				'&param_contra=' + txtContra.value,
        url: '../controlador/seguridad/cUsuario.php',
        success: function(data){
			console.log(data);
			if(data != 0){	
                location.href = "ventas/ventaCliente.php";  
			}
			else if (data == 0){
				alert('Datos no válidos.');	
			}
                    
        },
        error:function(data){
            alert('Error al mostrar');
        }
    });
    }

	</script>
	
</body>
</html>