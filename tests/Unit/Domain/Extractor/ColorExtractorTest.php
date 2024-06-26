<?php

declare(strict_types=1);

namespace App\Tests\Unit\Domain\Extractor;

use PHPUnit\Framework\TestCase;
use App\Domain\Extractor\ColorExtractor;
use App\Tests\Fixtures\ResponseArrayMother;

final class ColorExtractorTest extends TestCase
{
    /** @test */
    public function extract_colors_from_data(): void
    {
        // given
        $givenInputData = ResponseArrayMother::create();
        $expectedResult = ['colors' => ["Black","Dark Heather","Navy","Sport Grey","White"]];

        // when 
        $extractedColors = ColorExtractor::extract($givenInputData);

        // then
        $this->assertEquals($expectedResult, $extractedColors);
    }

    /** @test */
    public function extract_with_empty_colors(): void
    {
        // given
        $givenInputData = ['data' => ['colors' => []]];
        $expectedResult = ['colors' => []];

        // when 
        $extractedColors = ColorExtractor::extract($givenInputData);

        // then
        $this->assertEquals($expectedResult, $extractedColors);
    }

    /** @test */
    public function extract_with_no_colors_key(): void
    {
        // given
        $givenInputData = ['data' => []];
        $expectedResult = ['colors' => []];

        // when 
        $extractedColors = ColorExtractor::extract($givenInputData);

        // then
        $this->assertEquals($expectedResult, $extractedColors);
    }
}
