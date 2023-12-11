<div class="container">
	<div class="row">
		<div class="col12 text-center">
			<h1>Guest HMVC</h1>
			<?php 
			$action=$_ENV['SITE_URL'].'/messages';
			?>
			<form action="<?php print $action;?>" class="vertical" method="post">
				<label for="message">Mensagem:</label>
				<textarea name="message" id="message"></textarea>
				<button type="submit">Enviar</button>
			</form>
		</div>
	</div>
</div>