<?php include 'Header.php' ?>

	<main>
		<h1>Votre Compte </h1>

		<?php

		 if ( !isset($_SESSION['auth']) || $_SESSION['auth'] == []) {
		 	$_SESSION['flash']['danger'] = 'First login, would you?';
			header("Location: Login.php");
			exit();

		} elseif( isset($_SESSION['auth'] )) {
			echo "<h2> Bonjour  ".$_SESSION['auth']->name."</h2>";
		} ?>

		<p> Changer votre mot de passe ?</p>

		<?php if (!empty($errors)):?>
			<div class="alert alert-danger" style="margin-bottom: 0px">
				<p> Vous n'aves pas rempli le formulaire correctement </p>
				<ul>
					<?php foreach ($errors as $error):?>
						<li><?php echo $error; ?></li>
					<?php endforeach; ?>
				</ul>
			</div>

		<?php endif; ?>

		<form action="Traitement.php" method="POST">

			<div class="form-group">
				<label for="password"></label>
				<input type="password" name="password" required placeholder="Change password">
			</div>

			<div class="form-group">
				<label for="password_confirm"></label>
				<input type="password" name="password_confirm" required placeholder="Confirm password">
			</div>


			<input type="hidden" name="slug" value="newname">
			<button type="submit" class="btn btn-primary">Login</button>
			
		</form>

	</main>

<?php include 'Footer.php' ?>