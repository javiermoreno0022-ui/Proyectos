# Ficha de uso crítico de Inteligencia Artificial
## Laboratorio III – Integración de Sistemas

**Actividad:** Guía Práctica N.º 20 – Arquitectura y buenas prácticas  
**Apartado:** 10. Extra – Refactorizar con ayuda de IA (bajo control)  
**Herramienta utilizada:** ChatGPT  
**Fecha:** 18 de noviembre de 2026

### 1. Objetivo del uso de IA
Utilizar inteligencia artificial como apoyo para refactorizar el método `moverEstado()` del controlador `TransaccionController`, trasladando la lógica de negocio a la clase `TransaccionService`, sin modificar el comportamiento existente.

### 2. Prompt utilizado
Refactoriza el método `moverEstado()` de `TransaccionController.php`, moviendo exclusivamente la lógica de negocio a la clase existente `TransaccionService`.

- No cambies el comportamiento actual.
- No cambies nombres de campos, rutas, parámetros ni códigos HTTP.
- Conserva las transiciones permitidas:
  - Iniciada → Completada o Fallida.
  - Completada → ninguna transición.
  - Fallida → Iniciada.
- Conserva los mensajes de error y éxito.
- No agregues ni elimines validaciones.
- No uses métodos estáticos.
- El servicio no debe recibir objetos Request.
- Reutiliza las clases existentes.
- Mantén la autorización en el controlador.
- El controlador debe seguir realizando la redirección a `comercios.show`.
- Muestra únicamente los archivos modificados.

### 3. Archivos modificados
- `app/Services/TransaccionService.php`: se agregó el método `moverEstado()` para gestionar las transiciones permitidas y actualizar el estado.
- `app/Http/Controllers/TransaccionController.php`: se inyectó `TransaccionService` y se delegó la lógica de negocio al servicio.

### 4. Verificación humana
Se revisó el código generado y se comprobó que:
- Se conservaron los nombres de campos y rutas.
- Se mantuvieron las transiciones permitidas.
- Se conservaron los códigos HTTP y mensajes.
- El servicio no recibe objetos Request.
- No se utilizaron métodos estáticos.
- No se agregaron clases innecesarias.

### 5. Evidencia de pruebas

**Comando ejecutado:**
`php artisan test`

**Resultado:**
- 16 pruebas aprobadas.
- 35 aserciones.
- 0 pruebas fallidas.

### 6. Conclusión
La inteligencia artificial se utilizó como herramienta de apoyo para la refactorización. El código fue revisado manualmente y validado mediante las pruebas automatizadas del proyecto. La refactorización permitió separar las responsabilidades del controlador y del servicio sin alterar el comportamiento esperado.