<section id="login_principal">
<div class="container">
	<form id="contact" method="post" action="?c=main&a=login" data-parsley-validate>
		<h2>MyZone</h2>
		<h3>Scann</h3>
		<div class="input-field">
			<i class="fa fa-user" aria-hidden="true"></i>  <input id="email" type="email" class="validate" name="data[]" placeholder="Correo Electronico" required="required">
		</div>
		<div class="input-field">
	<i class="fa fa-unlock-alt" aria-hidden="true"></i> <input id="pass" type="password" name="data[]" class="validate" placeholder="Contraseña" required="required">
	<p class="key_olv"><a href="#">¿Ha olvidado su contraseña?</a></p>
	 </div>
	 <button type="submit" id="LoginButon" target="_self" class="hero-btn default">Ingresar</button>
	 <div class="row">
		 <form class="col s12">
			 <div class="row">
			 <div class=" col s6">
				 <p class="key"><a href="?c=usuario&a=viewCreate">Registrarse</a></p>
 		</div>
 		<div class="col s6">
			<p class="key">Ingresar con</a></p>
			<div class="col s3">
			<i class="fa fa-facebook" aria-hidden="true"></i>
		</div>
		<div class="col s3">
			<i class="fa fa-google" aria-hidden="true"></i>
		</div>
		</div>
		</div>
</form>
</div>

</section>
