<div class="container">
	<div class="row">
		<div class="col3"></div>
		<div class="col6 text-center">
			<h1>Guest HMVC</h1>
			<?php 
			$action=$_ENV['SITE_URL'].'/messages';
			?>
			<form action="<?php print $action;?>" class="vertical" method="post">
				<label for="message">Mensagem:</label>
				<textarea name="message" id="message" maxlength="128" minlength="1" required></textarea>
				<button type="submit">Enviar</button>
			</form>
			<?php 
			if($messages){
				foreach ($messages as $message) {
					print nl2br(htmlentities($message['message']));
					print '<br><small>';
					print date("r",$message['created_at']);
					print '</small>';
					print '<hr>';
				}
			}
			?>
		</div>
	</div>
</div>