<?php include 'Header.php' ?>
   
		<main >
		
			<section id="home">
				
		        <h1>Mathias Tardiff</h1>
				<h2>Developer, Traveler, Digital assistant, Polyglot, Pancakes lover</h2>
		        
		        <div  alt="Mathias Tardiff" id="profil"></div>
		        <p> Hi! My name is Mathias. Welcome to my website!</p>

			</section>

			<!-- ICI IL FAUT QUE JE CREE MON CONTENU about -->
			<section id="about">
		
				<h3>About me</h3>
				<p>Well, i became a web developer after crossing the path of digital nomads during my journey in Munich,
				and since then i decided to get the skills to become one of them. Now i'm really creating something 
				with my mind, and it feels great!</p>
		
			</section>
			
			<!-- ICI IL FAUT QUE JE CREE MON CONTENU PORTFOLIO -->
			<section id="portfolio">
			
				<h3>PortFolio</h3>
				<p> Here is some of my work and projects i've been involved with.</p>
				<img src="" alt="">
				<img src="" alt="">
				<img src="" alt="">
				
					
			</section>

			
			<!-- ICI IL FAUT QUE JE CREE MON formulaire de contact -->
			<section id="contact">
				
				<h3>Contact</h3>
				<p>Hey, just to let you know, here you can send me a message, i'll answer asap!</p>

				<?php if (!empty($errors)):?>

					<div class="alert alert-danger">
						
						<p> Vous n'aves pas rempli le formulaire correctement </p>

						<ul>

							<?php foreach ($errors as $error):?>

								<li><?php echo $error; ?></li>

							<?php endforeach; ?>

						</ul>

					</div>

				<?php endif; ?>
				
				<form name="form-contact" method="POST" action="traitement.php">
					<div class="form-group">
						<label for="name">Name</label>
						<input class="form-control" name="name" type="text" placeholder="Your name" required>
					</div>
					<div class="form-group">
						<label for="message">Message</label>
						<textarea class="form-control" name="message" placeholder="Your message" rows="8" cols="45" required>
						</textarea>
					</div>
					<input type="hidden" name="slug" value="message">
					<button type="submit" class="btn btn-primary">Send!</button>
				</form>
					
			</section>

		</main>
		<?php include 'Footer.php' ?>