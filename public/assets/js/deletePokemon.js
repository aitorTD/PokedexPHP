$('#modalDelete').on('click', function (event) {
    alert('Hola');
    let eliminarPokemon = document.getElementById('eliminarPokemon');
    let element = event.relatedTarget;
    let action = element.getAttribute('data-url');
    let name = element.dataset.name;
    eliminarPokemon.innerHTML = name;
    let form = document.getElementById('modalDeleteResourceForm');
    form.action = action;
    
})