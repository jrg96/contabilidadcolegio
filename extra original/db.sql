CREATE DATABASE contabilidad_colegio;
USE contabilidad_colegio;

--- Clase usuarios
CREATE TABLE tbl_usuario(
	id_usuario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	email VARCHAR(100) NOT NULL UNIQUE,
	password VARCHAR(50) NOT NULL,
	nombre_completo VARCHAR(200) NOT NULL,
	tipo VARCHAR(10) NOT NULL
);

--- Clase de cuentas: Activo, Pasivo, Capital
CREATE TABLE tbl_clase_cuenta(
    id_clase_cuenta INT PRIMARY KEY NOT NULL,
    clase_cuenta VARCHAR(50),
    abreviatura_clase_cuenta VARCHAR(5)
);

--- Grupo de cuenta: Circulante, No circulante
CREATE TABLE tbl_grupo_cuenta(
    id_grupo_cuenta INT PRIMARY KEY NOT NULL,
    grupo_cuenta VARCHAR(50),
    abreviatura_grupo_cuenta VARCHAR(5)
);

CREATE TABLE tbl_periodo_contable(
    id_periodo_contable INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    fecha_creacion DATETIME,
    fecha_inicio DATETIME,
    fecha_final DATETIME,
    meses_duracion INT,
    perc_utilidad_retenida INT,
    estado VARCHAR(100)
);

CREATE TABLE tbl_cuenta(
    id_cuenta_interno INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_clase_cuenta INT,
    id_grupo_cuenta INT,
    id_cuenta_mayor INT,
    id_cuenta INT,
    nombre_cuenta VARCHAR(150),
    atributo_cuenta VARCHAR(200),
    FOREIGN KEY (id_clase_cuenta) REFERENCES tbl_clase_cuenta(id_clase_cuenta),
    FOREIGN KEY (id_grupo_cuenta) REFERENCES tbl_grupo_cuenta(id_grupo_cuenta)
);

CREATE TABLE tbl_transaccion(
    id_transaccion INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_periodo_contable INT,
    id_cuenta_interno INT,
    monto DECIMAL(20, 2),
    esta_en_debe VARCHAR(2),
    es_transaccion_ajuste VARCHAR(2),
    fecha_realizacion DATETIME,
    FOREIGN KEY (id_periodo_contable) REFERENCES tbl_periodo_contable(id_periodo_contable),
    FOREIGN KEY (id_cuenta_interno) REFERENCES tbl_cuenta(id_cuenta_interno)
);


CREATE TABLE tbl_configuracion(
    perc_utilidad_retenida INT,
    longitud_periodo_contable INT
);

-- Parte de la contabilidad de costos
CREATE TABLE tbl_centro_costo(
	id_centro_costo INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nombre_centro_costo VARCHAR(200),
	descripcion_centro_costo VARCHAR(1000)
);

CREATE TABLE tbl_criterio_reparto_primario(
	id_criterio_reparto_primario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_cuenta_interno INT NOT NULL,
	nombre_criterio_reparto_primario VARCHAR(150),
	desc_criterio_reparto_primario VARCHAR(500),
	unidad_reparto VARCHAR(10),
	total_unidades DECIMAL(10,2),
	FOREIGN KEY(id_cuenta_interno) REFERENCES tbl_cuenta(id_cuenta_interno)
);

CREATE TABLE tbl_unidad_reparto_primario(
	id_unidad_reparto_primario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_criterio_reparto_primario INT NOT NULL,
	id_centro_costo INT NOT NULL,
	valor_unidad DECIMAL(10, 2),
	FOREIGN KEY(id_criterio_reparto_primario) REFERENCES tbl_criterio_reparto_primario(id_criterio_reparto_primario) ON DELETE CASCADE,
	FOREIGN KEY(id_centro_costo) REFERENCES tbl_centro_costo(id_centro_costo) ON DELETE CASCADE
);

CREATE TABLE tbl_actividad(
	id_actividad INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_centro_costo INT NOT NULL,
	nombre_actividad VARCHAR(200),
	descripcion_actividad VARCHAR(500),
	tipo_actividad VARCHAR(50),
	FOREIGN KEY(id_centro_costo) REFERENCES tbl_centro_costo(id_centro_costo) ON DELETE CASCADE
);

CREATE TABLE tbl_criterio_reparto_secundario(
	id_criterio_reparto_secundario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_centro_costo INT NOT NULL,
	nombre_criterio_reparto_secundario VARCHAR(150),
	desc_criterio_reparto_secundario VARCHAR(500),
	unidad_reparto VARCHAR(10),
	total_unidades DECIMAL(10, 2),
	FOREIGN KEY(id_centro_costo) REFERENCES tbl_centro_costo(id_centro_costo) ON DELETE CASCADE
);

CREATE TABLE tbl_unidad_reparto_secundario(
	id_unidad_reparto_secundario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_criterio_reparto_secundario INT NOT NULL,
	id_actividad INT NOT NULL,
	valor_unidad DECIMAL(10,2),
	FOREIGN KEY(id_criterio_reparto_secundario) REFERENCES tbl_criterio_reparto_secundario(id_criterio_reparto_secundario) ON DELETE CASCADE,
	FOREIGN KEY(id_actividad) REFERENCES tbl_actividad(id_actividad) ON DELETE CASCADE
);

CREATE TABLE tbl_criterio_reparto_terciario(
	id_criterio_reparto_terciario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_actividad_auxiliar INT NOT NULL,
	nombre_criterio_reparto_terciario VARCHAR(150),
	desc_criterio_reparto_terciario VARCHAR(500),
	unidad_reparto VARCHAR(10),
	total_unidades DECIMAL(10, 2),
	FOREIGN KEY(id_actividad_auxiliar) REFERENCES tbl_actividad(id_actividad) ON DELETE CASCADE
);

CREATE TABLE tbl_unidad_reparto_terciario(
	id_unidad_reparto_terciario INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_criterio_reparto_terciario INT NOT NULL,
	id_actividad INT NOT NULL,
	valor_unidad DECIMAL(10,2),
	FOREIGN KEY(id_criterio_reparto_terciario) REFERENCES tbl_criterio_reparto_terciario(id_criterio_reparto_terciario) ON DELETE CASCADE,
	FOREIGN KEY(id_actividad) REFERENCES tbl_actividad(id_actividad) ON DELETE CASCADE
);

CREATE TABLE tbl_inductor_costo(
	id_inductor_costo INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_actividad INT NOT NULL,
	nombre_inductor_costo VARCHAR(150),
	FOREIGN KEY(id_actividad) REFERENCES tbl_actividad(id_actividad) ON DELETE CASCADE
);

CREATE TABLE tbl_consumidor_costo(
	id_consumidor_costo INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nombre_consumidor_costo VARCHAR(150)
);

CREATE TABLE tbl_inductor_consumido(
	id_inductor_consumido INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_consumidor_costo INT NOT NULL,
	id_inductor_costo INT NOT NULL,
	valor_inductor INT,
	FOREIGN KEY(id_consumidor_costo) REFERENCES tbl_consumidor_costo(id_consumidor_costo) ON DELETE CASCADE,
	FOREIGN KEY(id_inductor_costo) REFERENCES tbl_inductor_costo(id_inductor_costo) ON DELETE CASCADE
);

--------- Planillas --------------
CREATE TABLE tbl_empleado(
	id_empleado INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nombre_empleado VARCHAR(200),
	fecha_contratacion DATETIME,
	salario_base_diario DECIMAL(10,2),
	tipo_empleado VARCHAR(100)
);

CREATE TABLE tbl_pago_empleado(
	id_pago_empleado INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_empleado INT NOT NULL,
	monto_pago DECIMAL(10, 2),
	fecha_pago DATETIME,
	id_transaccion_1 INT NOT NULL,
	id_transaccion_2 INT NOT NULL,
	FOREIGN KEY(id_transaccion_1) REFERENCES tbl_transaccion(id_transaccion) ON DELETE CASCADE,
	FOREIGN KEY(id_transaccion_2) REFERENCES tbl_transaccion(id_transaccion) ON DELETE CASCADE,
	FOREIGN KEY(id_empleado) REFERENCES tbl_empleado(id_empleado) ON DELETE CASCADE
);