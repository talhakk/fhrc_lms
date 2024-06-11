<section class="training-gallery">
    <div class="container">
        <div class="inner">
            <div class="head small">
                <h2>OUR GALLERY</h2>
            </div>
        </div>
    </div>
    <div class="row g-0">
            <div class="column">
                <img src="https://www.w3schools.com/howto/img_nature.jpg" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
            </div>
            <div class="column">
                <img src="https://www.w3schools.com/howto/img_snow.jpg" style="width:100%" onclick="openModal();currentSlide(2)" class="hover-shadow cursor">
            </div>
            <div class="column">
                <img src="https://www.w3schools.com/howto/img_mountains.jpg" style="width:100%" onclick="openModal();currentSlide(3)" class="hover-shadow cursor">
            </div>
            <div class="column">
                <img src="https://www.w3schools.com/howto/img_lights.jpg" style="width:100%" onclick="openModal();currentSlide(4)" class="hover-shadow cursor">
            </div>
            <div class="column">
                <img src="https://www.w3schools.com/howto/img_lights.jpg" style="width:100%" onclick="openModal();currentSlide(5)" class="hover-shadow cursor">
            </div>
            <div class="column">
                <img src="https://www.w3schools.com/howto/img_lights.jpg" style="width:100%" onclick="openModal();currentSlide(6)" class="hover-shadow cursor">
            </div>
        </div>
        <div id="myModal" class="modal">
            <span class="close cursor" onclick="closeModal()">&times;</span>
            <div class="modal-content">

                <div class="mySlides">
                    <div class="numbertext">1 / 6</div>
                    <img src="https://www.w3schools.com/howto/img_nature_wide.jpg" style="width:100%">
                </div>

                <div class="mySlides">
                    <div class="numbertext">2 / 6</div>
                    <img src="https://www.w3schools.com/howto/img_snow_wide.jpg" style="width:100%">
                </div>

                <div class="mySlides">
                    <div class="numbertext">3 / 6</div>
                    <img src="https://www.w3schools.com/howto/img_mountains_wide.jpg" style="width:100%">
                </div>

                <div class="mySlides">
                    <div class="numbertext">4 / 6</div>
                    <img src="https://www.w3schools.com/howto/img_lights_wide.jpg" style="width:100%">
                </div>
                <div class="mySlides">
                    <div class="numbertext">5 / 6</div>
                    <img src="https://www.w3schools.com/howto/img_lights_wide.jpg" style="width:100%">
                </div>
                <div class="mySlides">
                    <div class="numbertext">6 / 6</div>
                    <img src="https://www.w3schools.com/howto/img_lights_wide.jpg" style="width:100%">
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                <div class="caption-container">
                    <p id="caption"></p>
                </div>
                <div class="row g-0">
                    <div class="column">
                        <img class="demo cursor" src="https://www.w3schools.com/howto/img_nature_wide.jpg" style="width:100%" onclick="currentSlide(1)" alt="Nature and sunrise">
                    </div>
                    <div class="column">
                        <img class="demo cursor" src="https://www.w3schools.com/howto/img_snow_wide.jpg" style="width:100%" onclick="currentSlide(2)" alt="Snow">
                    </div>
                    <div class="column">
                        <img class="demo cursor" src="https://www.w3schools.com/howto/img_mountains_wide.jpg" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
                    </div>
                    <div class="column">
                        <img class="demo cursor" src="https://www.w3schools.com/howto/img_lights_wide.jpg" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
                    </div>
                    <div class="column">
                        <img class="demo cursor" src="https://www.w3schools.com/howto/img_lights_wide.jpg" style="width:100%" onclick="currentSlide(5)" alt="Northern 3">
                    </div>
                    <div class="column">
                        <img class="demo cursor" src="https://www.w3schools.com/howto/img_lights_wide.jpg" style="width:100%" onclick="currentSlide(6)" alt="Northern 4">
                    </div>
                </div>
            </div>
        </div>
</section>

<script>
    // Open the Modal
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides((slideIndex += n));
}

function currentSlide(n) {
  showSlides((slideIndex = n));
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
  captionText.innerHTML = dots[slideIndex - 1].alt;
}

</script>
        