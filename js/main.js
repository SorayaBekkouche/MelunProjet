
// menu burger
let open = document.querySelector('#openNav')
let nav = document.querySelector('#nav')
let close = document.querySelector('#close')

open.addEventListener('click', function () {
    nav.style.display = 'block'
})

close.addEventListener('click', function () {
    nav.style.display = 'none'
})

// formulaire
