<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriasSeeder extends Seeder
{
    public function run(): void
    {
        $materias = [

            // -------- SEMESTRE 1 ----------
            ['nombre' => 'Cálculo Diferencial', 'clave' => 'ACF-0901', 'creditos' => '3-2-5', 'semestre' => 1],
            ['nombre' => 'Fundamentos de Programación', 'clave' => 'SCC-1010', 'creditos' => '3-2-5', 'semestre' => 1],
            ['nombre' => 'Taller de Ética', 'clave' => 'ACH-2307', 'creditos' => '2-2-4', 'semestre' => 1],
            ['nombre' => 'Fundamentos de Investigación', 'clave' => 'ACC-0901', 'creditos' => '2-2-4', 'semestre' => 1],

            // -------- SEMESTRE 2 ----------
            ['nombre' => 'Cálculo Integral', 'clave' => 'ACF-0902', 'creditos' => '3-2-5', 'semestre' => 2],
            ['nombre' => 'Programación Orientada a Objetos', 'clave' => 'SCC-1011', 'creditos' => '3-2-5', 'semestre' => 2],
            ['nombre' => 'Álgebra Lineal', 'clave' => 'ACF-0903', 'creditos' => '3-2-5', 'semestre' => 2],
            ['nombre' => 'Química', 'clave' => 'AEF-1058', 'creditos' => '3-2-5', 'semestre' => 2],

            // -------- SEMESTRE 3 ----------
            ['nombre' => 'Cálculo Vectorial', 'clave' => 'ACF-0904', 'creditos' => '3-2-5', 'semestre' => 3],
            ['nombre' => 'Ecuaciones Diferenciales', 'clave' => 'ACE-0905', 'creditos' => '3-2-5', 'semestre' => 3],
            ['nombre' => 'Estructura de Datos', 'clave' => 'AED-1026', 'creditos' => '2-3-5', 'semestre' => 3],
            ['nombre' => 'Cultura Empresarial', 'clave' => 'SCC-1005', 'creditos' => '2-2-4', 'semestre' => 3],

            // -------- SEMESTRE 4 ----------
            ['nombre' => 'Probabilidad y Estadística', 'clave' => 'SCE-1000', 'creditos' => '3-2-5', 'semestre' => 4],
            ['nombre' => 'Graficación', 'clave' => 'SCC-1007', 'creditos' => '2-2-4', 'semestre' => 4],
            ['nombre' => 'Fundamentos de Base de Datos', 'clave' => 'SCC-1013', 'creditos' => '2-2-4', 'semestre' => 4],
            ['nombre' => 'Fundamentos de Telecomunicaciones', 'clave' => 'AEC-1034', 'creditos' => '2-2-4', 'semestre' => 4],

            // -------- SEMESTRE 5 ----------
            ['nombre' => 'Simulación', 'clave' => 'SCD-1022', 'creditos' => '2-3-5', 'semestre' => 5],
            ['nombre' => 'Sistemas Operativos', 'clave' => 'AEC-1001', 'creditos' => '2-2-4', 'semestre' => 5],
            ['nombre' => 'Métodos Numéricos', 'clave' => 'SCC-1017', 'creditos' => '2-2-4', 'semestre' => 5],
            ['nombre' => 'Investigación de Operaciones', 'clave' => 'AEF-1041', 'creditos' => '2-2-4', 'semestre' => 5],

            // -------- SEMESTRE 6 ----------
            ['nombre' => 'Lenguajes y Autómatas I', 'clave' => 'SCD-1015', 'creditos' => '2-3-5', 'semestre' => 6],
            ['nombre' => 'Redes de Computadoras', 'clave' => 'SCD-1021', 'creditos' => '2-3-5', 'semestre' => 6],
            ['nombre' => 'Taller de Sistemas Operativos', 'clave' => 'SCA-1026', 'creditos' => '0-4-4', 'semestre' => 6],
            ['nombre' => 'Administración de Bases de Datos', 'clave' => 'SCB-1001', 'creditos' => '1-4-5', 'semestre' => 6],

            // -------- SEMESTRE 7 ----------
            ['nombre' => 'Conmutación y Enrutamiento', 'clave' => 'SCD-1004', 'creditos' => '2-3-5', 'semestre' => 7],
            ['nombre' => 'Ingeniería de Software', 'clave' => 'SCD-1011', 'creditos' => '2-3-5', 'semestre' => 7],
            ['nombre' => 'Lenguajes de Interfaz', 'clave' => 'SCC-1014', 'creditos' => '2-2-4', 'semestre' => 7],
            ['nombre' => 'Programación Lógica y Funcional', 'clave' => 'SCC-1019', 'creditos' => '2-2-4', 'semestre' => 7],

            // -------- SEMESTRE 8 ----------
            ['nombre' => 'Inteligencia Artificial', 'clave' => 'SOC-1012', 'creditos' => '2-2-4', 'semestre' => 8],
            ['nombre' => 'Taller de Investigación I', 'clave' => 'ACA-0909', 'creditos' => '0-4-4', 'semestre' => 8],
            ['nombre' => 'Sistemas Programables', 'clave' => 'SOC-1023', 'creditos' => '2-2-4', 'semestre' => 8],

            // -------- SEMESTRE 9 ----------
            ['nombre' => 'Residencia Profesional', 'clave' => null, 'creditos' => '0-4-4', 'semestre' => 9],
            ['nombre' => 'Taller de Investigación II', 'clave' => 'ACA-0910', 'creditos' => '0-4-4', 'semestre' => 9],

            // -------- SEMESTRE 10 ----------
            ['nombre' => 'Programación Web', 'clave' => 'SCG-1009', 'creditos' => '3-3-6', 'semestre' => 10],
            ['nombre' => 'Gestión de Proyectos de Software', 'clave' => 'AEB-1055', 'creditos' => '1-4-5', 'semestre' => 10],
            ['nombre' => 'Programación Web Avanzada', 'clave' => 'SCG-1010', 'creditos' => '3-3-6', 'semestre' => 10],

        ];

        DB::table('materias')->insert($materias);
    }
}
