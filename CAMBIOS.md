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