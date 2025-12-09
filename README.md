# Pharma Track - Sistema de Gestión de Productos

## 📋 Descripción del Proyecto

**Pharma Track** es una aplicación web CRUD (Create, Read, Update, Delete) desarrollada en PHP con PDO para la gestión de productos en una droguería. Permite administrar el inventario de medicamentos, productos de higiene, suplementos y otros artículos farmacéuticos de forma eficiente.

## 🎯 Funcionalidades Principales

- **Listar Productos**: Visualizar todos los productos disponibles en la base de datos con detalles completos
- **Crear Productos**: Agregar nuevos productos con información como nombre, categoría, precio, stock, fecha de vencimiento, etc.
- **Editar Productos**: Modificar la información de productos existentes
- **Eliminar Productos**: Remover productos del inventario
- **Gestión de Categorías**: Organizar productos por categorías (Medicamentos, Higiene, Suplementos)
- **Control de Recetas**: Indicar si un producto requiere receta médica
- **Gestión de Proveedores**: Asociar productos con proveedores

## 🗂️ Estructura del Proyecto

```
pharmatrack_app/
├── config/
│   └── bd.php                 # Configuración de conexión PDO a MySQL
├── public/
│   ├── index.php              # Lista de todos los productos
│   ├── create.php             # Formulario para crear producto
│   ├── store.php              # Procesa y almacena nuevo producto
│   ├── edit.php               # Formulario para editar producto
│   ├── update.php             # Procesa actualización de producto
│   ├── delete.php             # Elimina un producto
│   ├── test.php               # Página de prueba
│   └── assets/
│       ├── css/
│       │   └── bootstrap.min.css
│       └── js/
│           ├── bootstrap.bundle.min.js
│           └── bootstrap.min.js
├── sql/
│   └── drogueriapharmatrack.sql  # Base de datos SQL completa
└── README.md                   # Este archivo
```

## 🗄️ Estructura de la Base de Datos

### Tablas Principales

#### **tabla `producto`**
```
- producto_id (INT) - ID único del producto
- nombre (VARCHAR) - Nombre del producto
- categoria_id (INT) - Referencia a categoría
- precio (DECIMAL) - Precio del producto
- stock (INT) - Cantidad en inventario
- fecha_vencimiento (DATE) - Fecha de vencimiento
- requiere_receta (BOOLEAN) - Si requiere receta (1/0)
- id_proveedor (INT) - ID del proveedor
```

#### **tabla `categoria`**
```
- categoria_id (INT) - ID única
- nombre (VARCHAR) - Nombre de categoría
- descripcion (TEXT) - Descripción
```

#### **tabla `proveedor`**
```
- proveedor_id (INT) - ID única
- nombre (VARCHAR) - Nombre del proveedor
- contacto (VARCHAR) - Información de contacto
```

#### **tabla `cliente`**
```
- cliente_id (INT) - ID única
- nombre (VARCHAR) - Nombre del cliente
- email (VARCHAR) - Email del cliente
```

## 🚀 Instalación y Configuración

### Requisitos
- PHP 8.0 o superior
- MySQL/MariaDB 10.4 o superior
- XAMPP (o servidor local similar)
- Navegador web moderno

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/Diego07265/proyecto-crud-php.git
   cd pharmatrack_app
   ```

2. **Importar la base de datos**
   - Abrir phpMyAdmin en `http://localhost/phpmyadmin`
   - Crear nueva base de datos llamada `drogueriapharmatrack`
   - Importar el archivo `sql/drogueriapharmatrack.sql`

3. **Configurar conexión a BD**
   - El archivo `config/bd.php` ya contiene las credenciales por defecto de XAMPP
   - Si es necesario, actualizar:
     - Host: `127.0.0.1`
     - Usuario: `root`
     - Contraseña: (vacío por defecto en XAMPP)
     - Base de datos: `drogueriapharmatrack`

4. **Verificar permisos**
   - Asegurarse que la carpeta tenga permisos de lectura/escritura

5. **Acceder a la aplicación**
   - Navegar a `http://localhost/pharmatrack_app/public/index.php`

## 💻 Tecnologías Utilizadas

- **Backend**: PHP 8.2 con `declare(strict_types=1)`
- **Base de Datos**: MySQL/MariaDB con PDO
- **Frontend**: HTML5, CSS3, Bootstrap 5.x
- **Control de Versiones**: Git/GitHub

## 🔐 Características de Seguridad

- ✅ **PDO Prepared Statements**: Prevención de SQL Injection
- ✅ **htmlspecialchars()**: Prevención de XSS
- ✅ **Type Hints Estrictos**: Validación de tipos en PHP
- ✅ **Error Handling**: Manejo de excepciones con try-catch
- ✅ **urlencode()**: Codificación segura de parámetros URL

## 📝 Archivos Clave

### `config/bd.php`
Configura la conexión a la base de datos usando PDO con manejo de excepciones.

### `public/index.php`
- Obtiene todos los productos ordenados por ID descendente
- Muestra tabla con detalles de productos
- Botones para editar, eliminar y agregar productos

### `public/create.php`
Formulario Bootstrap para crear nuevos productos con validación de campos.

### `public/store.php`
Procesa el envío del formulario y guarda el nuevo producto en la BD.

### `public/edit.php`
Formulario pre-rellenado para editar un producto existente.

### `public/update.php`
Procesa la actualización de datos del producto.

### `public/delete.php`
Elimina un producto de la base de datos con confirmación.

## 🎨 Interfaz de Usuario

- Diseño responsivo con Bootstrap 5
- Tabla de productos con estilos mejorados
- Formularios centrados y bien organizados
- Botones de acción (Editar, Eliminar, Agregar)
- Confirmación antes de eliminar productos
- Validación de campos requeridos

## 🐛 Errores Corregidos

- ✅ Error de sintaxis en `bd.php` (coma en lugar de punto y coma)
- ✅ Problema de `htmlspecialchars()` con valores numéricos (conversión a string)
- ✅ Estructura HTML incorrecta en tabla (solo mostraba 1 registro)
- ✅ Div vacío en `create.php` que rompía alineación del formulario

## 📊 Flujo de la Aplicación

```
index.php (Listar)
    ├── create.php → store.php (Crear)
    ├── edit.php → update.php (Editar)
    └── delete.php (Eliminar)
```

## 🔗 Enlaces Útiles

- **Repositorio**: https://github.com/Diego07265/proyecto-crud-php
- **Rama Activa**: main

## 👨‍💼 Autor

**Diego07265** - Desarrollo del Sistema Pharma Track

## 📄 Licencia

Este proyecto está disponible bajo licencia de código abierto.

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Para cambios mayores, abrir un issue primero para discutir los cambios propuestos.

---

**Última actualización**: 9 de Diciembre de 2025
**Estado**: ✅ Funcional y Operativo
