<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogosPopulate\Tests\Unit\Importers\Ccp\Injectors;

use PhpCfdi\SatCatalogosPopulate\AbstractCsvInjector;
use PhpCfdi\SatCatalogosPopulate\Importers\Ccp\Injectors\Transportes;
use PhpCfdi\SatCatalogosPopulate\InjectorInterface;
use PhpCfdi\SatCatalogosPopulate\Tests\TestCase;
use PhpCfdi\SatCatalogosPopulate\Utils\ArrayProcessors\RightTrim;
use PhpCfdi\SatCatalogosPopulate\Utils\CsvFile;
use RuntimeException;

class TransportesTest extends TestCase
{
    private string $sourceFile;

    private Transportes $injector;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sourceFile = $this->utilFilePath('ccp/c_CveTransporte.csv');
        $this->injector = new Transportes($this->sourceFile);
    }

    public function testTransportesExtendsAbstractCsvInjector(): void
    {
        $this->assertInstanceOf(AbstractCsvInjector::class, $this->injector);
        $this->assertInstanceOf(InjectorInterface::class, $this->injector);
    }

    public function testCheckHeadersOnValidSource(): void
    {
        $csv = new CsvFile($this->sourceFile, new RightTrim());
        $this->injector->checkHeaders($csv);

        $this->assertSame(4, $csv->position(), 'The csv position is on the first content line');
    }

    public function testCheckHeadersOnInvalidSource(): void
    {
        $csv = new CsvFile($this->utilFilePath('sample.csv'));

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('The headers did not match on file');
        $this->injector->checkHeaders($csv);
    }

    public function testDataTable(): void
    {
        $dataTable = $this->injector->dataTable();
        $this->assertSame('ccp_transportes', $dataTable->name());
        $this->assertSame(
            ['id', 'texto', 'vigencia_desde', 'vigencia_hasta'],
            $dataTable->fields()->keys()
        );
    }
}
