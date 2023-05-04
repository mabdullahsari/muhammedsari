let show = false;

const $toggle = document.getElementById('hamburger');
const $dropdown = $toggle.nextElementSibling;

$toggle.addEventListener('click', function () {
    performUpdate(! show);
});

function closeOnClick(event) {
    performUpdate(false);
}

function close() {
    $dropdown.classList.add('hidden');

    document.removeEventListener('click', closeOnClick);
}

function open() {
    $dropdown.classList.remove('hidden');

    setTimeout(() => {
        document.addEventListener('click', closeOnClick);
    }, 0);
}

function performUpdate(nextState) {
    show = nextState;

    if (show) {
        open();
    } else {
        close();
    }
}
