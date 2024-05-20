### Ejercicio: Encuestas de Satisfacción

Se requiere crear una página que permita realizar encuestas de satisfacción. El proceso consta de los siguientes pasos:

1. **Preguntas de la Encuesta**:
   - Se leerá un archivo de texto que contendrá las preguntas de la encuesta, donde cada línea representará una pregunta.
   - Por cada pregunta del archivo, se mostrará una encuesta de satisfacción en la página. Cada pregunta tendrá tres opciones de respuesta: nada, normal, mucho.

2. **Formulario de Respuestas**:
   - Se mostrará un formulario que solicitará al usuario su nombre y presentará todas las preguntas de la encuesta.
   - Por cada pregunta, se mostrará un conjunto de radio buttons con las opciones de respuesta.
   - Todas las preguntas serán obligatorias.

3. **Procesamiento de Respuestas**:
   - Una vez que el usuario envíe sus respuestas, estas se guardarán en un archivo CSV para su posterior análisis.
   - El formato de cada respuesta en el archivo CSV será: `nombre;respuesta1;respuesta2;respuesta3`.

**Requisitos:**
- Las respuestas de la encuesta deben ser almacenadas en un archivo CSV.
- Se debe mostrar un mensaje de error si el usuario no completa todas las preguntas antes de enviar el formulario.

### Implementación:

A continuación, se presenta una propuesta de estructura y diseño para la página de la encuesta:

**Encuesta de Satisfacción:**

Por favor, complete la siguiente encuesta respondiendo a cada pregunta con una de las opciones: nada, normal, mucho.

1. ¿Cómo de contento está con el producto?
   - [ ] Nada
   - [ ] Normal
   - [ ] Mucho

2. ¿Está conforme con el precio del producto?
   - [ ] Nada
   - [ ] Normal
   - [ ] Mucho

3. ¿Considera...?
   - [ ] Nada
   - [ ] Normal
   - [ ] Mucho

**Formulario de Respuestas:**

Por favor, introduzca su nombre y seleccione una opción para cada pregunta. Todas las preguntas son obligatorias.

[Formulario de Respuestas](#formulario-de-respuestas)

**Procesamiento de Respuestas:**

Una vez que haya enviado sus respuestas, se guardarán en un archivo CSV para su posterior análisis.

Ejemplo de formato de respuesta en CSV: `nombre;respuesta1;respuesta2;respuesta3`.

[Procesamiento de Respuestas](#procesamiento-de-respuestas)

### Consideraciones Finales:

- Se recomienda implementar un mecanismo para manejar el envío de respuestas y el procesamiento de datos de forma segura y eficiente.
- Es importante validar los datos ingresados por el usuario para garantizar la integridad y corrección de la información almacenada en el archivo CSV.
