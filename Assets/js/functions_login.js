//si se usa como efecto para mostrar y ocultar elementos no hay problema
$('.login-content [data-toggle="flip"]').click(function() {
	$('.login-box').toggleClass('flipped');
	return false;
});


//var divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
	if(document.querySelector("#formLogin")){
		let formLogin = document.querySelector("#formLogin");
		formLogin.onsubmit = function(e) {
			e.preventDefault();

			let strEmail = document.querySelector('#txtEmail').value;
			let strPassword = document.querySelector('#txtPassword').value;

			if(strEmail == "" || strPassword == "")
			{
				swal("Por favor", "Escribe usuario y contraseñaa.", "error");
				return false;
			}else{
				//divLoading.style.display = "flex";
				var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				var ajaxUrl = base_url+'/Login/loginUser'; 
				var formData = new FormData(formLogin);
				request.open("POST",ajaxUrl,true);
				request.send(formData);
				request.onreadystatechange = function(){
					if(request.readyState != 4) return;
					if(request.status == 200){
						//aca se tranca
						var objData = JSON.parse(request.responseText);
						console.log(request.responseText);
						if(objData.status)
						{
						//	window.location = base_url+'/dashboard';  ->si hay login en la vista enviaria al dashboard
							window.location.reload(false); // -> con esto ya no envia al dash sino sigue la secuencia del if else q esta en ela vista
						}else{ 
							swal("Atención", objData.msg, "error");
							document.querySelector('#txtPassword').value = "";
						}
					}else{
						swal("Atención","Error en el proceso", "error");
					}
				//	divLoading.style.display = "none";
					return false;
				}
			}
		}
	}



}, false);