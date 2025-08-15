//logut
function logout() {
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'logout.php';
    form.innerHTML = '<input type="hidden" name="logout" value="true">';
    document.body.appendChild(form);
    form.submit();
}


//Vidcaorulsesl
const videos = document.querySelectorAll('.hero-background'); //PERHATIAN DISINI!!!!!!!!!!!!!!
let currentVideo = 0;
function changeVideo() {
  let nextVideo;
  do {
    nextVideo = Math.floor(Math.random() * videos.length);
  } while (nextVideo === currentVideo);
  videos[currentVideo].classList.remove('active');
  currentVideo = nextVideo;
  videos[currentVideo].classList.add('active');
  videos[currentVideo].play();
}
videos.forEach(video => {
  video.addEventListener('ended', changeVideo);
});
videos[currentVideo].classList.add('active');
videos[currentVideo].play();
window.addEventListener('scroll', () => {
  const navbar = document.querySelector('.uk-navbar-container');
  if (window.scrollY > 50) {
    navbar.classList.remove('uk-navbar-transparent');
  } else {
    navbar.classList.add('uk-navbar-transparent');
  }
});