<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogosPopulate\Tests\Features\Importers;

use PhpCfdi\SatCatalogosPopulate\Database\Repository;
use PhpCfdi\SatCatalogosPopulate\Importers\SourcesImporter;
use PhpCfdi\SatCatalogosPopulate\Tests\TestCase;
use Psr\Log\NullLogger;

class SourcesImporterTest extends TestCase
{
    public function testImportSourcesFromFolder(): void
    {
        $sourceFolder = $this->utilFilePath('sources/');
        $repository = new Repository(':memory:');

        $importer = new SourcesImporter();

        $importer->import($sourceFolder, $repository, new NullLogger());

        $expectedTables = [
            'cfdi_paises',
            'cfdi_tipos_factores',
            'cfdi_productos_servicios',
            'cfdi_codigos_postales',
            'cfdi_claves_unidades',
            'cfdi_patentes_aduanales',
            'cfdi_regimenes_fiscales',
            'cfdi_aduanas',
            'cfdi_monedas',
            'cfdi_metodos_pago',
            'cfdi_tipos_comprobantes',
            'cfdi_tipos_relaciones',
            'cfdi_impuestos',
            'cfdi_formas_pago',
            'cfdi_usos_cfdi',
            'cfdi_40_aduanas',
            'cfdi_40_claves_unidades',
            'cfdi_40_codigos_postales',
            'cfdi_40_colonias',
            'cfdi_40_estados',
            'cfdi_40_exportaciones',
            'cfdi_40_formas_pago',
            'cfdi_40_impuestos',
            'cfdi_40_localidades',
            'cfdi_40_meses',
            'cfdi_40_metodos_pago',
            'cfdi_40_monedas',
            'cfdi_40_municipios',
            'cfdi_40_numeros_pedimento_aduana',
            'cfdi_40_objetos_impuestos',
            'cfdi_40_paises',
            'cfdi_40_patentes_aduanales',
            'cfdi_40_periodicidades',
            'cfdi_40_productos_servicios',
            'cfdi_40_regimenes_fiscales',
            'cfdi_40_reglas_tasa_cuota',
            'cfdi_40_tipos_comprobantes',
            'cfdi_40_tipos_factores',
            'cfdi_40_tipos_relaciones',
            'cfdi_40_usos_cfdi',
            'cce_claves_pedimentos',
            'cce_tipos_operacion',
            'cce_estados',
            'cce_unidades_medida',
            'cce_motivos_traslado',
            'cce_colonias',
            'cce_municipios',
            'cce_incoterms',
            'cce_fracciones_arancelarias',
            'cce_localidades',
            'nomina_tipos_contratos',
            'nomina_bancos',
            'nomina_riesgos_puestos',
            'nomina_periodicidades_pagos',
            'nomina_tipos_horas',
            'nomina_tipos_jornadas',
            'nomina_estados',
            'nomina_tipos_nominas',
            'nomina_origenes_recursos',
            'nomina_tipos_otros_pagos',
            'nomina_tipos_incapacidades',
            'nomina_tipos_deducciones',
            'nomina_tipos_percepciones',
            'nomina_tipos_regimenes',
            'pagos_tipos_cadena_pago',
            'ccp_autorizaciones_naviero',
            'ccp_claves_unidades',
            'ccp_codigos_transporte_aereo',
            'ccp_colonias',
            'ccp_configuraciones_autotransporte',
            'ccp_configuraciones_maritimas',
            'ccp_contenedores',
            'ccp_contenedores_maritimos',
            'ccp_derechos_de_paso',
            'ccp_estaciones',
            'ccp_figuras_transporte',
            'ccp_localidades',
            'ccp_materiales_peligrosos',
            'ccp_municipios',
            'ccp_partes_transporte',
            'ccp_productos_servicios',
            'ccp_tipos_carga',
            'ccp_tipos_carro',
            'ccp_tipos_embalaje',
            'ccp_tipos_estacion',
            'ccp_tipos_permiso',
            'ccp_tipos_remolque',
            'ccp_tipos_servicio',
            'ccp_tipos_trafico',
            'ccp_transportes',
        ];

        foreach ($expectedTables as $expectedTable) {
            $this->assertTrue(
                $repository->hasTable($expectedTable),
                "The table $expectedTable was not found in repository"
            );
            $this->assertGreaterThan(0, $repository->getRecordCount($expectedTable));
        }
    }
}
