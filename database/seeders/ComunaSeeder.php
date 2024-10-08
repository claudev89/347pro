<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comunas')->insert([
            ['nombre' => 'Arica', 'region_id' => 1],
            ['nombre' => 'Camarones', 'region_id' => 1],
            ['nombre' => 'General Lagos', 'region_id' => 1],
            ['nombre' => 'Putre', 'region_id' => 1],

            ['nombre' => 'Alto Hospicio', 'region_id' => 2],
            ['nombre' => 'Camiña', 'region_id' => 2],
            ['nombre' => 'Colchane', 'region_id' => 2],
            ['nombre' => 'Huara', 'region_id' => 2],
            ['nombre' => 'Iquique', 'region_id' => 2],
            ['nombre' => 'Pica', 'region_id' => 2],

            ['nombre' => 'Antofagasta', 'region_id' => 3],
            ['nombre' => 'Calama', 'region_id' => 3],
            ['nombre' => 'María Elena', 'region_id' => 3],
            ['nombre' => 'Mejillones', 'region_id' => 3],
            ['nombre' => 'Ollagüe', 'region_id' => 3],
            ['nombre' => 'San Pedro de Atacama', 'region_id' => 3],
            ['nombre' => 'Sierra Gorda', 'region_id' => 3],
            ['nombre' => 'Taltal', 'region_id' => 3],
            ['nombre' => 'Tocopilla', 'region_id' => 3],

            ['nombre' => 'Alto del Carmen', 'region_id' => 4],
            ['nombre' => 'Caldera', 'region_id' => 4],
            ['nombre' => 'Chañaral', 'region_id' => 4],
            ['nombre' => 'Copiapó', 'region_id' => 4],
            ['nombre' => 'Diego de Almagro', 'region_id' => 4],
            ['nombre' => 'Freirina', 'region_id' => 4],
            ['nombre' => 'Huasco', 'region_id' => 4],
            ['nombre' => 'Tierra Amarilla', 'region_id' => 4],
            ['nombre' => 'Vallenar', 'region_id' => 4],

            ['nombre' => 'Andacollo', 'region_id' => 5],
            ['nombre' => 'Canela', 'region_id' => 5],
            ['nombre' => 'Combarbalá', 'region_id' => 5],
            ['nombre' => 'Coquimbo', 'region_id' => 5],
            ['nombre' => 'Illapel', 'region_id' => 5],
            ['nombre' => 'La Higuera', 'region_id' => 5],
            ['nombre' => 'La Serena', 'region_id' => 5],
            ['nombre' => 'Los Vilos', 'region_id' => 5],
            ['nombre' => 'Monte Patria', 'region_id' => 5],
            ['nombre' => 'Ovalle', 'region_id' => 5],
            ['nombre' => 'Paihuano', 'region_id' => 5],
            ['nombre' => 'Punitaqui', 'region_id' => 5],
            ['nombre' => 'Río Hurtado', 'region_id' => 5],
            ['nombre' => 'Salamanca', 'region_id' => 5],
            ['nombre' => 'Vicuña', 'region_id' => 5],

            ['nombre' => 'Algarrobo', 'region_id' => 6],
            ['nombre' => 'Cabildo', 'region_id' => 6],
            ['nombre' => 'Calle Larga', 'region_id' => 6],
            ['nombre' => 'Cartagena', 'region_id' => 6],
            ['nombre' => 'Casablanca', 'region_id' => 6],
            ['nombre' => 'Catemu', 'region_id' => 6],
            ['nombre' => 'Concón', 'region_id' => 6],
            ['nombre' => 'El Quisco', 'region_id' => 6],
            ['nombre' => 'El Tabo', 'region_id' => 6],
            ['nombre' => 'Hijuelas', 'region_id' => 6],
            ['nombre' => 'Isla de Pascua (Rapa Nui)', 'region_id' => 6],
            ['nombre' => 'Juan Fernández', 'region_id' => 6],
            ['nombre' => 'La Calera', 'region_id' => 6],
            ['nombre' => 'La Cruz', 'region_id' => 6],
            ['nombre' => 'La Ligua', 'region_id' => 6],
            ['nombre' => 'Limache', 'region_id' => 6],
            ['nombre' => 'Llay-Llay', 'region_id' => 6],
            ['nombre' => 'Los Andes', 'region_id' => 6],
            ['nombre' => 'Nogales', 'region_id' => 6],
            ['nombre' => 'Olmué', 'region_id' => 6],
            ['nombre' => 'Panquehue', 'region_id' => 6],
            ['nombre' => 'Papudo', 'region_id' => 6],
            ['nombre' => 'Petorca', 'region_id' => 6],
            ['nombre' => 'Puchuncaví', 'region_id' => 6],
            ['nombre' => 'Quillota', 'region_id' => 6],
            ['nombre' => 'Quilpué', 'region_id' => 6],
            ['nombre' => 'Quintero', 'region_id' => 6],
            ['nombre' => 'San Antonio', 'region_id' => 6],
            ['nombre' => 'San Esteban', 'region_id' => 6],
            ['nombre' => 'San Felipe', 'region_id' => 6],
            ['nombre' => 'Santa María', 'region_id' => 6],
            ['nombre' => 'Santo Domingo', 'region_id' => 6],
            ['nombre' => 'Valparaíso', 'region_id' => 6],
            ['nombre' => 'Villa Alemana', 'region_id' => 6],
            ['nombre' => 'Viña del Mar', 'region_id' => 6],
            ['nombre' => 'Zapallar', 'region_id' => 6],

            ['nombre' => 'Alhué', 'region_id' => 7],
            ['nombre' => 'Buin', 'region_id' => 7],
            ['nombre' => 'Calera de Tango', 'region_id' => 7],
            ['nombre' => 'Cerrillos', 'region_id' => 7],
            ['nombre' => 'Cerro Navia', 'region_id' => 7],
            ['nombre' => 'Colina', 'region_id' => 7],
            ['nombre' => 'Conchalí', 'region_id' => 7],
            ['nombre' => 'Curacaví', 'region_id' => 7],
            ['nombre' => 'El Bosque', 'region_id' => 7],
            ['nombre' => 'Estación Central', 'region_id' => 7],
            ['nombre' => 'Huechuraba', 'region_id' => 7],
            ['nombre' => 'Independencia', 'region_id' => 7],
            ['nombre' => 'Isla de Maipo', 'region_id' => 7],
            ['nombre' => 'La Cisterna', 'region_id' => 7],
            ['nombre' => 'La Florida', 'region_id' => 7],
            ['nombre' => 'La Granja', 'region_id' => 7],
            ['nombre' => 'La Pintana', 'region_id' => 7],
            ['nombre' => 'La Reina', 'region_id' => 7],
            ['nombre' => 'Lampa', 'region_id' => 7],
            ['nombre' => 'Las Condes', 'region_id' => 7],
            ['nombre' => 'Lo Barnechea', 'region_id' => 7],
            ['nombre' => 'Lo Espejo', 'region_id' => 7],
            ['nombre' => 'Lo Prado', 'region_id' => 7],
            ['nombre' => 'Macul', 'region_id' => 7],
            ['nombre' => 'Maipú', 'region_id' => 7],
            ['nombre' => 'María Pinto', 'region_id' => 7],
            ['nombre' => 'Melipilla', 'region_id' => 7],
            ['nombre' => 'Ñuñoa', 'region_id' => 7],
            ['nombre' => 'Padre Hurtado', 'region_id' => 7],
            ['nombre' => 'Paine', 'region_id' => 7],
            ['nombre' => 'Pedro Aguirre Cerda', 'region_id' => 7],
            ['nombre' => 'Peñaflor', 'region_id' => 7],
            ['nombre' => 'Peñalolén', 'region_id' => 7],
            ['nombre' => 'Pirque', 'region_id' => 7],
            ['nombre' => 'Providencia', 'region_id' => 7],
            ['nombre' => 'Pudahuel', 'region_id' => 7],
            ['nombre' => 'Puente Alto', 'region_id' => 7],
            ['nombre' => 'Quilicura', 'region_id' => 7],
            ['nombre' => 'Quinta Normal', 'region_id' => 7],
            ['nombre' => 'Recoleta', 'region_id' => 7],
            ['nombre' => 'Renca', 'region_id' => 7],
            ['nombre' => 'San Bernardo', 'region_id' => 7],
            ['nombre' => 'San Joaquín', 'region_id' => 7],
            ['nombre' => 'San José de Maipo', 'region_id' => 7],
            ['nombre' => 'San Miguel', 'region_id' => 7],
            ['nombre' => 'San Pedro', 'region_id' => 7],
            ['nombre' => 'San Ramón', 'region_id' => 7],
            ['nombre' => 'Santiago', 'region_id' => 7],
            ['nombre' => 'Talagante', 'region_id' => 7],
            ['nombre' => 'Tiltil', 'region_id' => 7],
            ['nombre' => 'Vitacura', 'region_id' => 7],

            ['nombre' => 'Chimbarongo', 'region_id' => 8],
            ['nombre' => 'Chépica', 'region_id' => 8],
            ['nombre' => 'Codegua', 'region_id' => 8],
            ['nombre' => 'Coinco', 'region_id' => 8],
            ['nombre' => 'Coltauco', 'region_id' => 8],
            ['nombre' => 'Doñihue', 'region_id' => 8],
            ['nombre' => 'Graneros', 'region_id' => 8],
            ['nombre' => 'La Estrella', 'region_id' => 8],
            ['nombre' => 'Las Cabras', 'region_id' => 8],
            ['nombre' => 'Litueche', 'region_id' => 8],
            ['nombre' => 'Lolol', 'region_id' => 8],
            ['nombre' => 'Machalí', 'region_id' => 8],
            ['nombre' => 'Malloa', 'region_id' => 8],
            ['nombre' => 'Marchigüe', 'region_id' => 8],
            ['nombre' => 'Nancagua', 'region_id' => 8],
            ['nombre' => 'Navidad', 'region_id' => 8],
            ['nombre' => 'Olivar', 'region_id' => 8],
            ['nombre' => 'Palmilla', 'region_id' => 8],
            ['nombre' => 'Paredones', 'region_id' => 8],
            ['nombre' => 'Peralillo', 'region_id' => 8],
            ['nombre' => 'Peumo', 'region_id' => 8],
            ['nombre' => 'Pichidegua', 'region_id' => 8],
            ['nombre' => 'Pichilemu', 'region_id' => 8],
            ['nombre' => 'Placilla', 'region_id' => 8],
            ['nombre' => 'Pumanque', 'region_id' => 8],
            ['nombre' => 'Quinta de Tilcoco', 'region_id' => 8],
            ['nombre' => 'Rancagua', 'region_id' => 8],
            ['nombre' => 'Requínoa', 'region_id' => 8],
            ['nombre' => 'Rengo', 'region_id' => 8],
            ['nombre' => 'San Fernando', 'region_id' => 8],
            ['nombre' => 'San Francisco de Mostazal', 'region_id' => 8],
            ['nombre' => 'San Vicente', 'region_id' => 8],
            ['nombre' => 'Santa Cruz', 'region_id' => 8],

            ['nombre' => 'Cauquenes', 'region_id' => 9],
            ['nombre' => 'Chanco', 'region_id' => 9],
            ['nombre' => 'Colbún', 'region_id' => 9],
            ['nombre' => 'Constitución', 'region_id' => 9],
            ['nombre' => 'Curicó', 'region_id' => 9],
            ['nombre' => 'Empedrado', 'region_id' => 9],
            ['nombre' => 'Hualañé', 'region_id' => 9],
            ['nombre' => 'Licantén', 'region_id' => 9],
            ['nombre' => 'Linares', 'region_id' => 9],
            ['nombre' => 'Longaví', 'region_id' => 9],
            ['nombre' => 'Maule', 'region_id' => 9],
            ['nombre' => 'Molina', 'region_id' => 9],
            ['nombre' => 'Parral', 'region_id' => 9],
            ['nombre' => 'Pelluhue', 'region_id' => 9],
            ['nombre' => 'Pencahue', 'region_id' => 9],
            ['nombre' => 'Rauco', 'region_id' => 9],
            ['nombre' => 'Retiro', 'region_id' => 9],
            ['nombre' => 'Río Claro', 'region_id' => 9],
            ['nombre' => 'Romeral', 'region_id' => 9],
            ['nombre' => 'Sagrada Familia', 'region_id' => 9],
            ['nombre' => 'San Clemente', 'region_id' => 9],
            ['nombre' => 'San Javier', 'region_id' => 9],
            ['nombre' => 'San Rafael', 'region_id' => 9],
            ['nombre' => 'Talca', 'region_id' => 9],
            ['nombre' => 'Teno', 'region_id' => 9],
            ['nombre' => 'Vichuquén', 'region_id' => 9],
            ['nombre' => 'Villa Alegre', 'region_id' => 9],
            ['nombre' => 'Yerbas Buenas', 'region_id' => 9],

            ['nombre' => 'Bulnes', 'region_id' => 10],
            ['nombre' => 'Chillán', 'region_id' => 10],
            ['nombre' => 'Chillán Viejo', 'region_id' => 10],
            ['nombre' => 'Cobquecura', 'region_id' => 10],
            ['nombre' => 'Coelemu', 'region_id' => 10],
            ['nombre' => 'Coihueco', 'region_id' => 10],
            ['nombre' => 'El Carmen', 'region_id' => 10],
            ['nombre' => 'Ninhue', 'region_id' => 10],
            ['nombre' => 'Ñiquén', 'region_id' => 10],
            ['nombre' => 'Pemuco', 'region_id' => 10],
            ['nombre' => 'Pinto', 'region_id' => 10],
            ['nombre' => 'Portezuelo', 'region_id' => 10],
            ['nombre' => 'Quillón', 'region_id' => 10],
            ['nombre' => 'Quirihue', 'region_id' => 10],
            ['nombre' => 'Ránquil', 'region_id' => 10],
            ['nombre' => 'San Carlos', 'region_id' => 10],
            ['nombre' => 'San Fabián', 'region_id' => 10],
            ['nombre' => 'San Ignacio', 'region_id' => 10],
            ['nombre' => 'San Nicolás', 'region_id' => 10],
            ['nombre' => 'Treguaco', 'region_id' => 10],
            ['nombre' => 'Yungay', 'region_id' => 10],

            ['nombre' => 'Alto Biobío', 'region_id' => 11],
            ['nombre' => 'Antuco', 'region_id' => 11],
            ['nombre' => 'Arauco', 'region_id' => 11],
            ['nombre' => 'Cabrero', 'region_id' => 11],
            ['nombre' => 'Cañete', 'region_id' => 11],
            ['nombre' => 'Chiguayante', 'region_id' => 11],
            ['nombre' => 'Concepción', 'region_id' => 11],
            ['nombre' => 'Contulmo', 'region_id' => 11],
            ['nombre' => 'Coronel', 'region_id' => 11],
            ['nombre' => 'Curanilahue', 'region_id' => 11],
            ['nombre' => 'Florida', 'region_id' => 11],
            ['nombre' => 'Hualpén', 'region_id' => 11],
            ['nombre' => 'Hualqui', 'region_id' => 11],
            ['nombre' => 'Laja', 'region_id' => 11],
            ['nombre' => 'Lota', 'region_id' => 11],
            ['nombre' => 'Los Álamos', 'region_id' => 11],
            ['nombre' => 'Los Ángeles', 'region_id' => 11],
            ['nombre' => 'Mulchén', 'region_id' => 11],
            ['nombre' => 'Nacimiento', 'region_id' => 11],
            ['nombre' => 'Negrete', 'region_id' => 11],
            ['nombre' => 'Penco', 'region_id' => 11],
            ['nombre' => 'Quilaco', 'region_id' => 11],
            ['nombre' => 'Quilleco', 'region_id' => 11],
            ['nombre' => 'San Pedro de la Paz', 'region_id' => 11],
            ['nombre' => 'San Rosendo', 'region_id' => 11],
            ['nombre' => 'Santa Bárbara', 'region_id' => 11],
            ['nombre' => 'Santa Juana', 'region_id' => 11],
            ['nombre' => 'Talcahuano', 'region_id' => 11],
            ['nombre' => 'Tomé', 'region_id' => 11],
            ['nombre' => 'Tucapel', 'region_id' => 11],
            ['nombre' => 'Yumbel', 'region_id' => 11],

            ['nombre' => 'Angol', 'region_id' => 12],
            ['nombre' => 'Carahue', 'region_id' => 12],
            ['nombre' => 'Cholchol', 'region_id' => 12],
            ['nombre' => 'Collipulli', 'region_id' => 12],
            ['nombre' => 'Cunco', 'region_id' => 12],
            ['nombre' => 'Curacautín', 'region_id' => 12],
            ['nombre' => 'Curarrehue', 'region_id' => 12],
            ['nombre' => 'Ercilla', 'region_id' => 12],
            ['nombre' => 'Freire', 'region_id' => 12],
            ['nombre' => 'Galvarino', 'region_id' => 12],
            ['nombre' => 'Gorbea', 'region_id' => 12],
            ['nombre' => 'Lautaro', 'region_id' => 12],
            ['nombre' => 'Loncoche', 'region_id' => 12],
            ['nombre' => 'Lonquimay', 'region_id' => 12],
            ['nombre' => 'Los Sauces', 'region_id' => 12],
            ['nombre' => 'Lumaco', 'region_id' => 12],
            ['nombre' => 'Melipeuco', 'region_id' => 12],
            ['nombre' => 'Nueva Imperial', 'region_id' => 12],
            ['nombre' => 'Padre Las Casas', 'region_id' => 12],
            ['nombre' => 'Perquenco', 'region_id' => 12],
            ['nombre' => 'Pitrufquén', 'region_id' => 12],
            ['nombre' => 'Pucón', 'region_id' => 12],
            ['nombre' => 'Purén', 'region_id' => 12],
            ['nombre' => 'Renaico', 'region_id' => 12],
            ['nombre' => 'Saavedra', 'region_id' => 12],
            ['nombre' => 'Temuco', 'region_id' => 12],
            ['nombre' => 'Teodoro Schmidt', 'region_id' => 12],
            ['nombre' => 'Toltén', 'region_id' => 12],
            ['nombre' => 'Traiguén', 'region_id' => 12],
            ['nombre' => 'Victoria', 'region_id' => 12],
            ['nombre' => 'Vilcún', 'region_id' => 12],
            ['nombre' => 'Villarrica', 'region_id' => 12],

            ['nombre' => 'Corral', 'region_id' => 13],
            ['nombre' => 'Futrono', 'region_id' => 13],
            ['nombre' => 'Lago Ranco', 'region_id' => 13],
            ['nombre' => 'Lanco', 'region_id' => 13],
            ['nombre' => 'La Unión', 'region_id' => 13],
            ['nombre' => 'Los Lagos', 'region_id' => 13],
            ['nombre' => 'Máfil', 'region_id' => 13],
            ['nombre' => 'Mariquina', 'region_id' => 13],
            ['nombre' => 'Panguipulli', 'region_id' => 13],
            ['nombre' => 'Paillaco', 'region_id' => 13],
            ['nombre' => 'Río Bueno', 'region_id' => 13],
            ['nombre' => 'Valdivia', 'region_id' => 13],

            ['nombre' => 'Ancud', 'region_id' => 14],
            ['nombre' => 'Calbuco', 'region_id' => 14],
            ['nombre' => 'Castro', 'region_id' => 14],
            ['nombre' => 'Chaitén', 'region_id' => 14],
            ['nombre' => 'Chonchi', 'region_id' => 14],
            ['nombre' => 'Cochamó', 'region_id' => 14],
            ['nombre' => 'Curaco de Vélez', 'region_id' => 14],
            ['nombre' => 'Dalcahue', 'region_id' => 14],
            ['nombre' => 'Fresia', 'region_id' => 14],
            ['nombre' => 'Frutillar', 'region_id' => 14],
            ['nombre' => 'Futaleufú', 'region_id' => 14],
            ['nombre' => 'Hualaihué', 'region_id' => 14],
            ['nombre' => 'Llanquihue', 'region_id' => 14],
            ['nombre' => 'Los Muermos', 'region_id' => 14],
            ['nombre' => 'Maullín', 'region_id' => 14],
            ['nombre' => 'Osorno', 'region_id' => 14],
            ['nombre' => 'Palena', 'region_id' => 14],
            ['nombre' => 'Puerto Montt', 'region_id' => 14],
            ['nombre' => 'Puerto Octay', 'region_id' => 14],
            ['nombre' => 'Puqueldón', 'region_id' => 14],
            ['nombre' => 'Purranque', 'region_id' => 14],
            ['nombre' => 'Puyehue', 'region_id' => 14],
            ['nombre' => 'Queilén', 'region_id' => 14],
            ['nombre' => 'Quellón', 'region_id' => 14],
            ['nombre' => 'Quemchi', 'region_id' => 14],
            ['nombre' => 'Quinchao', 'region_id' => 14],
            ['nombre' => 'Río Negro', 'region_id' => 14],
            ['nombre' => 'San Juan de la Costa', 'region_id' => 14],
            ['nombre' => 'San Pablo', 'region_id' => 14],

            ['nombre' => 'Aysén', 'region_id' => 15],
            ['nombre' => 'Chile Chico', 'region_id' => 15],
            ['nombre' => 'Cisnes', 'region_id' => 15],
            ['nombre' => 'Cochrane', 'region_id' => 15],
            ['nombre' => 'Coyhaique', 'region_id' => 15],
            ['nombre' => 'Guaitecas', 'region_id' => 15],
            ['nombre' => 'Lago Verde', 'region_id' => 15],
            ['nombre' => "O'Higgins", 'region_id' => 15],
            ['nombre' => 'Río Ibáñez', 'region_id' => 15],
            ['nombre' => 'Tortel', 'region_id' => 15],

            ['nombre' => 'Antártica', 'region_id' => 16],
            ['nombre' => 'Cabo de Hornos', 'region_id' => 16],
            ['nombre' => 'Laguna Blanca', 'region_id' => 16],
            ['nombre' => 'Natales', 'region_id' => 16],
            ['nombre' => 'Porvenir', 'region_id' => 16],
            ['nombre' => 'Primavera', 'region_id' => 16],
            ['nombre' => 'Punta Arenas', 'region_id' => 16],
            ['nombre' => 'Río Verde', 'region_id' => 16],
            ['nombre' => 'San Gregorio', 'region_id' => 16],
        ]);
    }
}
