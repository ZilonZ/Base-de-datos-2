-- ============================================================
-- Script SQL para crear la Base de Datos y Tabla
-- Base de Datos: todolist
-- Sistema: PostgreSQL
-- ============================================================

-- 1. CREAR BASE DE DATOS
CREATE DATABASE todolist
    WITH 
    ENCODING 'UTF8'
    LOCALE 'es_ES.UTF-8'
    TEMPLATE template0;

-- 2. CONECTAR A LA BASE DE DATOS
-- Ejecutar esta línea en psql: \c todolist

-- 3. CREAR TABLA TASKS
CREATE TABLE tasks (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. CREAR ÍNDICE PARA OPTIMIZAR BÚSQUEDAS
CREATE INDEX idx_tasks_completed ON tasks(completed);
CREATE INDEX idx_tasks_created_at ON tasks(created_at DESC);

-- 5. INSERTAR DATOS DE PRUEBA (Opcional)
INSERT INTO tasks (title, completed) VALUES
    ('Comprar víveres', FALSE),
    ('Estudiar PostgreSQL', FALSE),
    ('Revisar el CRUD', TRUE),
    ('Hacer ejercicio', FALSE),
    ('Terminar proyecto', FALSE);

-- Verificar que la tabla se creó correctamente
-- SELECT * FROM tasks;
