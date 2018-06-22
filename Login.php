<?php include 'Header.php' ;?>

	<main>

		<h1> Se connecter </h1>

	<?php
		if (isset($_SESSION['flash'])) {
	
			foreach ($_SESSION['flash'] as $type => $message) {
				
				echo '<div class="alert alert-'.$type.'" style="margin-bottom: 0px"><ul><li>'.$message.'</li></ul></div>';
			}

			unset($_SESSION["flash"]);
		}

	?>
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
				<label for="name"></label>
				<input type="text" name="name" required placeholder="Name or Email">
			</div>

			<div class="form-group">
				<label for="password"></label>
				<input type="password" name="password" required placeholder="Password">
			</div>

			<div class="form-group">
				<a href="forget.php">J'ai oublié mon mot de passe</a>	
			</div>
			
			<input type="hidden" name="slug" value="imback">
			<button type="submit" class="btn btn-primary">Login</button>
			
		</form>
		
		
	</main>

<?php include 'Footer.php' ;?>