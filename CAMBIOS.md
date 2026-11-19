# Registro de cambios · TaskBoard API

# 2026-11-06

# Corregido - MT-013: 
GET /api/transacciones responde 422 si ?estado no es Iniciada, Completada o Fallida (antes: 200 con lista vacía).

⚠ Clientes que enviaban estados mal escritos verán 422.

# Agregado - MT-014: 

GET /api/transacciones/filtrar acepta los parámetros opcionales monto_min y monto_max para filtrar transacciones por rango de monto.

monto_min: establece el monto mínimo permitido. Debe ser numérico y mayor o igual a 0.

monto_max: establece el monto máximo permitido. Debe ser numérico y mayor o igual a 0.

Si se envían ambos parámetros, monto_max debe ser mayor o igual que monto_min.

Los filtros existentes (estado, desde y hasta) continúan funcionando.

No se modificaron las rutas, el modelo, la base de datos ni el formato de respuesta existente.

Los nuevos parámetros son opcionales, por lo que las peticiones anteriores siguen funcionando sin cambios.

# 2026-11-18

# Cambiado - Refactorización de servicios (Laboratorio III)

Se refactorizó la lógica de registro y actualización de transacciones para trasladar las responsabilidades de negocio desde el controlador API hacia TransaccionService.

- El método store del controlador delega el registro de transacciones al servicio.
- El método update delega el cambio de estado al servicio.
- Se conservaron las validaciones, respuestas y códigos HTTP existentes.
- Se mantuvieron las pruebas automatizadas de registro y actualización.

También se refactorizó el método moverEstado del controlador web:

- Se trasladaron las reglas de transición de estados a TransaccionService.
- El controlador conserva la autorización y la redirección.
- Se mantuvieron los estados permitidos, mensajes y código HTTP 400.

Se verificó el comportamiento mediante php artisan test.

Resultado: 16 pruebas aprobadas y 35 aserciones.

También se incorporó el Enum EstadoTransaccion para centralizar los estados permitidos de las transacciones:

- Se definieron los estados Iniciada, Completada y Fallida.
- Se actualizaron el modelo, las solicitudes, los controladores y el recurso API para utilizar el Enum.

Se refactorizó el cálculo de comisiones aplicando el principio abierto/cerrado (OCP):

- Se creó la interfaz ReglaComision.
- Se implementaron reglas independientes para tarjeta y transferencia.
- Se agregó la regla de billetera con una comisión del 2 %.
- Se actualizó CalculadoraComision para trabajar con las reglas registradas mediante inyección de dependencias.