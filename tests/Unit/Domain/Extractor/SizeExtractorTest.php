<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Extractor;

use PHPUnit\Framework\TestCase;
use App\Domain\Extractor\SizeExtractor;
use App\Tests\Fixtures\ResponseJsonMother;

final class SizeExtractorTest extends TestCase
{
    /** @test */
    public function extract_sizes_from_data()
    {
        // given
        $givenInputData = ResponseJsonMother::create();
        $expectedResult = ['sizes' => ["S","M","L","XL","2XL","3XL"]];

        // when 
        $extractedSizes = SizeExtractor::extract($givenInputData);

        // then
        $this->assertEquals($expectedResult, $extractedSizes);
    }

    /** @test */
    public function extract_with_empty_sizes()
    {
        // given
        $givenInputData = ['data' => ['sizes' => []]];
        $expectedResult = ['sizes' => []];

        // when 
        $extractedSizes = SizeExtractor::extract($givenInputData);

        // then
        $this->assertEquals($expectedResult, $extractedSizes);
    }

    /** @test */
    public function extract_with_no_sizes_key()
    {
        // given
        $givenInputData = ['data' => []];
        $expectedResult = ['sizes' => []];

        // when 
        $extractedSizes = SizeExtractor::extract($givenInputData);

        // then
        $this->assertEquals($expectedResult, $extractedSizes);
    }
}
