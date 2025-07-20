// Cuando el usuario selecciona una imagen
/*
document.getElementById('image-input').addEventListener('change', function() {
    // Obtiene la imagen cargada
    var image = this.files[0];

    // Crea un objeto de la biblioteca Tinypng
    var tinypng = new tinypng('TU_CLAVE_API');

    // Comprime la imagen y devuelve el archivo comprimido
    tinypng.compress(image)
        .then(function(result) {
            // Crea una nueva imagen en el DOM con la imagen comprimida
            var compressedImage = new Image();
            compressedImage.src = URL.createObjectURL(result.file);

            // Agrega la imagen comprimida a la página
            document.body.appendChild(compressedImage);

            // Envía la imagen comprimida al servidor de Laravel para su almacenamiento
            // (Este código dependerá de cómo manejes la subida de imágenes en Laravel)
            var formData = new FormData();
            formData.append('image', result.file, 'compressed-image.png');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/guardar-imagen');
            xhr.send(formData);
        });
});
*/