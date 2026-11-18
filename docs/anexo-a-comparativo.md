# Anexo A. Cuadro comparativo de frameworks de back-end

**Proyecto:** Sistema de Pedidos a Domicilio  
**Framework seleccionado:** Laravel 13  
**Framework comparado:** Django + Django REST Framework

| Criterio | Laravel 13 | Django + Django REST Framework |
|---|---|---|
| **Lenguaje y ecosistema** | PHP y Composer. Ecosistema amplio para aplicaciones web y API REST. | Python y pip. Django REST Framework amplía las capacidades de Django para crear API REST. |
| **Curva de aprendizaje** | Baja para nuestro equipo, porque ya tenemos experiencia con PHP y Laravel. | Mayor para nuestro equipo, porque requiere aprender Python y las herramientas de Django REST Framework. |
| **ORM y acceso a datos** | Eloquent ORM, que facilita las consultas y relaciones entre modelos. | Django ORM, que permite gestionar modelos, consultas y relaciones con la base de datos. |
| **Autenticación de API** | Laravel Sanctum, utilizado en nuestro proyecto para autenticar solicitudes mediante tokens. | TokenAuthentication de Django REST Framework, que permite autenticar solicitudes mediante tokens. |
| **Herramientas de pruebas** | PHPUnit y herramientas de pruebas HTTP de Laravel, como `postJson()`. | APITestCase y APIClient de Django REST Framework para probar endpoints. |
| **Despliegue y hosting** | Compatible con servidores que soportan PHP y los requisitos de Laravel. Dispone de opciones de alojamiento compartido compatibles. | Requiere un entorno de alojamiento compatible con Python y la configuración de su servidor de aplicaciones. |
| **Escenario donde conviene más** | Aplicaciones web y API REST cuando el equipo domina PHP y necesita desarrollar en poco tiempo. | Aplicaciones Python que necesitan un panel administrativo integrado y herramientas para desarrollar API REST. |

## Conclusión

Para nuestro proyecto **Sistema de Pedidos a Domicilio** elegimos Laravel 13 porque el equipo tiene experiencia previa con PHP y Laravel, permite reducir el tiempo de desarrollo y proporciona herramientas para implementar API REST, autenticación, validaciones y operaciones CRUD. Además, su integración con MySQL y Laravel Sanctum facilita el desarrollo y la protección de los pedidos asociados a cada usuario.

Django con Django REST Framework también es una alternativa adecuada, especialmente porque ofrece un panel administrativo integrado, un ORM propio y herramientas para desarrollar API REST. Sería preferible si nuestro equipo tuviera experiencia en Python o necesitara aprovechar directamente su panel de administración. Sin embargo, en nuestro caso Laravel resulta más conveniente porque ya conocemos sus herramientas, tenemos una implementación avanzada y contamos con un plazo académico limitado.

La matriz de decisión ponderada respalda esta elección, ya que Laravel obtuvo 4.75 puntos frente a los 3.20 de Django, de acuerdo con los criterios y pesos establecidos para nuestro proyecto.