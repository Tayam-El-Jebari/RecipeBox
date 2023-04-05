window.addEventListener('scroll', function() {
  let navigation = document.getElementById('navigation');

  if (window.scrollY > navigation.offsetHeight) {
    navigation.classList.add('scrolling');
  } else {
    navigation.classList.remove('scrolling');
  }
});
