places = document.querySelector('#quantity')
place1 = document.querySelector('#place1')
place2 = document.querySelector('#place2')
place3 = document.querySelector('#place3')
max3 = document.querySelector('#max3')

places.addEventListener('input', (e) => {
    value = e.target.value
    if (e.target.value < 1) {
        e.target.value = 1
        return
    }
    if (e.target.value > 3) {
        e.target.value = 3
        return
    }

    if (e.target.value == 1) {
        place2.classList.add('d-none')
        place3.classList.add('d-none')
    } else if (e.target.value == 2) {
        place2.classList.remove('d-none')
        place3.classList.add('d-none')
        max3.classList.add('d-none')
    } else if (e.target.value == 3) {
        place2.classList.remove('d-none')
        place3.classList.remove('d-none')
        max3.classList.remove('d-none')
    }
})