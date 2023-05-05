const $backdrop = document.getElementById('mobile-nav-backdrop');
const $mobileNav = document.getElementById('mobile-nav');
const $close = document.getElementById('mobile-nav-close');
const $open = document.getElementById('mobile-nav-open');

$backdrop.addEventListener('click', () => $mobileNav.classList.add('hidden'));
$close.addEventListener('click', () => $mobileNav.classList.add('hidden'));
$open.addEventListener('click', () => $mobileNav.classList.remove('hidden'));
