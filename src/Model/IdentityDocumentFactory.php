<?php

declare(strict_types=1);

namespace Appvise\Verifai\Model;

class IdentityDocumentFactory extends AbstractFactory
{

    /**
     * @param array{data:string[], pages:string[], report:string[]} $data 
     * @return IdentityDocument 
     */
    public static function fromArray(array $data): IdentityDocument
    {
        return new IdentityDocument(
            DataFactory::fromArray(self::pluckArray('data', $data)),
            self::extractPages(self::pluckArray('pages', $data)),
            ReportFactory::fromArray(self::pluckArray('report', $data))
        );
    }

    /**
     * @param string[][] $pages 
     * @return Page[]
     */
    private static function extractPages(array $pages): array
    {
        $p = [];
        foreach ($pages as $page) {
            array_push($p, PageFactory::fromArray($page));
        }
        return $p;
    }
}

