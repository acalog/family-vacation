<div class="gallery">
	<!-- using the total number of images, calculate how many total columns and how many images per column  -->
	<div class="gallery__column">

		@include('content.gallery-column', ['filename' => $filename, 'description' => $description])
		
		<a href="https://unsplash.com/@jeka_fe" target="_blank" class="gallery__link">
			<figure class="gallery__thumb">
				<img src="https://source.unsplash.com/_cvwXhGqG-o/300x300" alt="Portrait by Jessica Felicio" class="gallery__image">
				<figcaption class="gallery__caption">Portrait by Jessica Felicio</figcaption>
			</figure>
		</a>

		<a href="https://unsplash.com/@oladimeg" target="_blank" class="gallery__link">
			<figure class="gallery__thumb">
				<img src="https://source.unsplash.com/AHBvAIVqk64/300x500" alt="Portrait by Oladimeji Odunsi" class="gallery__image">
				<figcaption class="gallery__caption">Portrait by Oladimeji Odunsi</figcaption>
			</figure>
		</a>

		<a href="https://unsplash.com/@a2eorigins" target="_blank" class="gallery__link">
			<figure class="gallery__thumb">
				<img src="https://source.unsplash.com/VLPLo-GtrIE/300x300" alt="Portrait by Alex Perez" class="gallery__image">
				<figcaption class="gallery__caption">Portrait by Alex Perez</figcaption>
			</figure>
		</a>
	</div>
	
</div>