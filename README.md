# Guía Didáctica Interactiva de Laravel (NT1 — NT5)
### Universidad Adventista de Chile (UNACH)
**Facultad de Ingeniería y Ciencias del Trabajo** **Asignatura:** Electivo Profesional I — Desarrollo Web con Laravel  
**Nota 2 (20%):** Guía Didáctica de Núcleos Temáticos  
**Año Académico:** 2026  

---

## Identificación del Equipo y Colaboración (Dimensión 4)
* **Alumno:** Benjamín Felipe Rivera Araneda (Ingeniería Civil Informática)

---

## Descripción del Proyecto
Este proyecto consiste en una aplicación web interactiva y autoexplicativa diseñada bajo el patrón arquitectónico **Modelo-Vista-Controlador (MVC)** utilizando **Laravel 12**. Funciona como una bitácora de aprendizaje y guía didáctica real que cubre de manera profunda los primeros 5 núcleos temáticos del curso (NT1 al NT5).

Para unificar la práctica de forma profesional y con pertinencia técnica, se implementó un caso de negocio real: un **Sistema de Diagnóstico y Gestión de Hardware de Laboratorio de Computación**. A través de esta temática, la aplicación demuestra la interacción de rutas, controladores, plantillas avanzadas de Blade y persistencia en base de datos con validaciones estrictas en español.

---

## Requisitos Previos y Stack Tecnológico
* **Servidor Local:** XAMPP v8.2+ (Módulos Apache y MySQL).
* **Gestor de Dependencias:** Composer v2.x+.
* **Control de Versiones:** Git y cuenta en GitHub (Repositorio público).
* **Frontend:** TailwindCSS (vía CDN) para una interfaz responsiva y fluida.
* **Formatos de Código:** Highlight.js (Tema Atom One Dark vía CDN) para el resaltado de sintaxis interactivo.

---

## Instrucciones de Instalación Paso a Paso (Dimensión 3)

Siga estas instrucciones detalladas para clonar, instalar y desplegar el proyecto en un entorno de desarrollo local utilizando XAMPP:

### 1. Clonar el repositorio público
Abra una terminal en su directorio de proyectos y ejecute:
```bash
git clone https://github.com/devbenjaminrivera/Evaluaci-n2.git
cd Evaluaci-n2
```

### 2. Instalar las dependencias de PHP con Composer
```bash
composer install
```

### 3. Configurar las Variables de Entorno
Copie el archivo de ejemplo preconfigurado para generar el entorno definitivo:
```bash
cp .env.example .env
```
Abra el archivo `.env` recién creado y asegúrese de que la sección de la base de datos esté configurada para apuntar al servidor MySQL de XAMPP de la siguiente manera:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_unach
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generar la clave de seguridad de la aplicación
```bash
php artisan key:generate
```

### 5. Crear la Base de Datos en XAMPP
1. Inicie el panel de control de **XAMPP** y active **Apache** y **MySQL**.
2. Diríjase a su navegador e ingrese a `http://localhost/phpmyadmin`.
3. Haga clic en **"Nueva"** en el panel izquierdo.
4. Escriba el nombre exacto de la base de datos: `laravel_unach`.
5. Seleccione el cotejamiento `utf8mb4_unicode_ci` y presione **"Crear"**.

### 6. Ejecutar Migraciones y Cargar Datos de Prueba (Seeders)
Este comando destruirá cualquier residuo previo, creará la estructura de tablas y sembrará la información inicial:
```bash
php artisan config:clear
php artisan migrate:fresh --seed
```

### 7. Levantar el Servidor Local
```bash
php artisan serve
```
Acceda en su navegador a: **[http://localhost:8000](http://localhost:8000)**

---

## Estructura y Script de la Base de Datos (Persistencia Real)
La persistencia de datos exigida por la pauta se centraliza en la tabla `equipos`, la cual almacena la información de hardware del taller informático.

### Código de la Migración (`database/migrations/xxxx_create_equipos_table.php`):
```php
public function up(): void
{
    Schema::create('equipos', function (Blueprint $table) {
        $table->id();
        $table->string('marca');              // Ej: Lenovo, HP, Asus
        $table->string('modelo');             // Ej: IdeaPad 5, Pavilion
        $table->string('diagnostico')->nullable(); // Descripción del fallo técnico
        $table->string('estado');             // Operativo, En Taller, Pendiente
        $table->timestamps();                 // created_at y updated_at
    });
}
```

### Script del Sembrador (`database/seeders/EquipoSeeder.php`):
Inserta automáticamente registros iniciales basados en problemas reales de hardware (incluyendo errores de energía de placas base y rutinas de soporte) para verificar la conexión de datos de inmediato.

---

## Historial de Núcleos, Descripciones de Pruebas y Evidencias (Dimensión 3)

A continuación se detalla el comportamiento técnico de cada núcleo temático, la descripción estricta de las pruebas realizadas en el navegador y las capturas de pantalla correspondientes (mínimo 2 por núcleo):

### 🔹 NT1: Introducción a Laravel y Fundamentos
* **Descripción de la Prueba:** Se levantó el servidor y se accedió al módulo de Introducción. Se verificó que el layout maestro heredara de forma correcta la barra de navegación lateral y los CDNs. Se probó el funcionamiento del helper dinámico `config()` y la inyección en tiempo real de las versiones del núcleo de Laravel y PHP del servidor local en las tarjetas informativas.
* **Evidencias Visuales:**
  ![NT1 - Vista Teórica y Estructura](public/evidencias/nt1_teoria.png)
  ![NT1 - Panel de Entorno del Servidor](public/evidencias/nt1_practica.png)

### 🔹 NT2: Rutas y Controladores
* **Descripción de la Prueba:** Se ingresó al simulador de tarifas de pasajes del módulo. Se probó el envío de un formulario mediante el método HTTP `POST` hacia `RutasControlador`. El controlador recibió con éxito la inyección del objeto `Request`, procesó lógicamente el descuento por Tarjeta Nacional Estudiantil (TNE) y retornó a la misma vista redirigiendo con una sesión flash (`with()`), desplegando el cuadro verde de respuesta.
* **Evidencias Visuales:**
  ![NT2 - Código de Enrutamiento Moderno](public/evidencias/nt2_teoria.png)
  ![NT2 - Simulador de Petición POST Funcional](public/evidencias/nt2_practica.png)

### 🔹 NT3: Vistas y Blade Templates
* **Descripción de la Prueba:** Se testeó la inyección de una colección multidimensional desde `BladeControlador`. En la vista, se comprobó el correcto renderizado dinámico de una tabla HTML utilizando la directiva `@foreach`. Se verificó el funcionamiento de los condicionales `@if` para evaluar el estado académico de las asignaturas y se explotó la variable mágica `$loop` para pintar de forma alternada las filas (`$loop->even`) y destacar el inicio y término del arreglo.
* **Evidencias Visuales:**
  ![NT3 - Directivas y Sintaxis de Compilación](public/evidencias/nt3_teoria.png)
  ![NT3 - Tabla de Cursos Evaluada por Blade](public/evidencias/nt3_practica.png)

### 🔹 NT4: Modelos y Bases de Datos (Eloquent ORM)
* **Descripción de la Prueba:** Se comprobó la comunicación con el motor MySQL de XAMPP. La vista ejecuta con éxito una llamada orientada a objetos mediante el ORM a través de `Equipo::all()`. Se validó que, al renderizar la tabla de estado de hardware, el bucle fuera capaz de interpretar los objetos de la base de datos y pintar dinámicamente insignias (Badges) de color verde, amarillo o rojo según el estado guardado.
* **Evidencias Visuales:**
  ![NT4 - Mapeo Relacional de Modelos](public/evidencias/nt4_teoria.png)
  ![NT4 - Renderizado de Hardware desde MySQL](public/evidencias/nt4_practica.png)

### 🔹 NT5: Formularios y Validaciones
* **Descripción de la Prueba:** Se realizaron dos pruebas críticas en este módulo. Primero, se presionó el botón de envío con los campos del formulario de ingreso de hardware completamente vacíos, verificando que Laravel interceptara la petición, cancelara el almacenamiento y retornara desplegando los mensajes de error personalizados en español mediante la directiva `@error`. Segundo, se realizó un registro válido completo; se verificó que la función `save()` persistiera los datos en la base de datos MySQL de XAMPP y que el registro apareciera de inmediato en el inventario del NT4.
* **Evidencias Visuales:**
  ![NT5 - Interceptación y Errores de Validación](public/evidencias/nt5_errores.png)
  ![NT5 - Persistencia Exitosa en Base de Datos](public/evidencias/nt5_exito.png)

---
*Este proyecto cumple estrictamente con el patrón arquitectónico MVC, control de excepciones en Blade, sanitización de datos y los requisitos de documentación de la pauta de evaluación de la Universidad Adventista de Chile.*