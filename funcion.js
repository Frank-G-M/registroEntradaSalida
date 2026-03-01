function iniciarJornada() {
    fetch("iniciar.php")
        .then(response => response.text())
        .then(data => {
            location.reload();
        })
        .catch(error => console.log(error));
}

function cerrarJornada() {
    fetch("cerrar.php")
        .then(response => response.text())
        .then(data => {
            location.reload();
        })
        .catch(error => console.log(error));
}