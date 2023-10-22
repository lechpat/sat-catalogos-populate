<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogosPopulate\Importers\Ccp30\Injectors;

use PhpCfdi\SatCatalogosPopulate\AbstractCsvInjector;
use PhpCfdi\SatCatalogosPopulate\Database\DataFields;
use PhpCfdi\SatCatalogosPopulate\Database\DataTable;
use PhpCfdi\SatCatalogosPopulate\Database\DateDataField;
use PhpCfdi\SatCatalogosPopulate\Database\TextDataField;
use PhpCfdi\SatCatalogosPopulate\Utils\CsvFile;
use RuntimeException;

class DerechosDePaso extends AbstractCsvInjector
{
    public function checkHeaders(CsvFile $csv): void
    {
        $csv->move(3);
        $expected = [
            'Clave del derecho de paso',
            'Derecho de paso',
            'Entre',
            'Hasta',
            'Otorga/Recibe',
            'Concesionario',
            'Fecha de inicio de vigencia',
            'Fecha de fin de vigencia',
        ];
        $headers = $csv->readLine();

        if ($expected !== $headers) {
            throw new RuntimeException("The headers did not match on file {$this->sourceFile()}");
        }
        $csv->next();
    }

    public function dataTable(): DataTable
    {
        return new DataTable('ccp_30_derechos_de_paso', new DataFields([
            new TextDataField('id'),
            new TextDataField('texto'),
            new TextDataField('entre'),
            new TextDataField('hasta'),
            new TextDataField('otorga_recibe'),
            new TextDataField('concesionario'),
            new DateDataField('vigencia_desde'),
            new DateDataField('vigencia_hasta'),
        ]));
    }
}
