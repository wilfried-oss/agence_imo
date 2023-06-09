const buttons = document.querySelectorAll("[data-carousel-button]");
buttons.forEach((button) => {
  button.addEventListener("click", () => {
    const offset = button.dataset.carouselButton === "next" ? 1 : -1;
    const slides = button
      .closest("[data-carousel]")
      .querySelector("data-slides");

    const activeSlides = slides.querySelector("data-active");
    let newIndex = [...slides.children].indexOf(activeSlides) + offset;
    if (newIndex < 0) newIndex = slides.children.length - 1;
    if (newIndex >= slides.children.length) newIndex = 0;

    slides.children[newIndex].dataset.active = true;
    delete activeSlides.dataset.active;
  });
});
const section = $(`
  		<section aria-label="Images de la Propriété">
            <div class="carousel" data-carousel>
                <button class="carousel-button prev" data-carousel-button="prev">&#8656;</button>
                <button class="carousel-button next" data-carousel-button="next">&#8658;</button>
                <ul data-slides="">
                    @foreach ($property->images as $image)
                        <li class="slide" data-active>
                            <img style="max-width: 50%; height: auto;" src="{{ Storage::url($image->url) }}" alt="image">
                        </li>
                    @endforeach
                </ul>
            </div>
        </section> 
	`);
