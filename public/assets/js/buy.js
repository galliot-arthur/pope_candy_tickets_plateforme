places = document.querySelector('#quantity')
inputContainer = document.querySelector('#inputContainer')

const duplicateInput = (value) => {
    inputContainer.innerHTML = ""
    for (let i = 0; i < value; i++) {
        baba = `<div class="input-group mb-3">
            <label 
                class="input-group-text" 
                for="holder_name${i}">
                Porteur
                </label>
            <input 
                type="text"
                class="form-control"
                name="holder_name${i}"
                id="holder_name${i}"
                placeholder="Jeremy Dubois"
                required>
            <label 
                class="input-group-text" 
                for="type${i}">
                Tarif
                </label>
            <select 
                class="form-select" 
                name="type${i}"
                id="type${i}"
                requiered>
                <option selected>Choisir...</option>
                {% for price in prices %}
                    <option
                        value="{{ price.id }}">
                        {{ price.ticket_name }}
                        </option>
                {% endfor %}
            </select>
            </div>`
        inputContainer.innerHTML += baba
    }
}

places.addEventListener('input', (e) => {
    value = e.target.value
    if (e.target.value < 1) {
        e.target.value = 1
        return
    }
    /*     if (e.target.value == 3) {
            places.parentElement.innerHTML += `<span 
                                                class="input-group-text">
                                                3 max
                                                </span>`
        } */
    if (e.target.value > 3) {
        e.target.value = 3
        return
    }
    duplicateInput(value)
})