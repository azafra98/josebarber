var card = document.querySelector('.card');
card.addEventListener('mouseover', function() {
    card.classList.add('is-flipped');
});
card.addEventListener('mouseout', function() {
    card.classList.remove('is-flipped');
});