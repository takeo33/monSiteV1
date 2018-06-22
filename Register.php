<?php include 'Header.php' ?>

	<main>
		
		<h1>S'inscrire</h1>

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
				<input type="text" name="name" required placeholder="Name">
			</div>

			<div class="form-group">
				<label for="email"></label>
				<input type="email" name="email" required placeholder="Email">
			</div>

			<div class="form-group">
				<label for="password"></label>
				<input type="password" name="password" required placeholder="Password">
			</div>

			<div class="form-group">
				<label for="password_confirm"></label>
				<input type="password" name="password_confirm" required placeholder="Confirm password">
			</div>

			<input type="hidden" name="slug" value="welcome">
			<button type="submit"class="btn btn-primary">Register</button>
			
		</form>
		
	</main>

<?php include 'Footer.php' ?>