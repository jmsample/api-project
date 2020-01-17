<?php

use JournalMedia\Sample\Validator\TagValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class TagValidatorTest
 */
class TagValidatorTest extends TestCase
{

    public function testValidate()
    {
        // Validate correct tags
        $this->assertTrue(TagValidator::validate('google'));
        $this->assertTrue(TagValidator::validate('apple'));
        $this->assertTrue(TagValidator::validate('early-adopters'));

        // Validate incorrect tags
        $this->assertFalse(TagValidator::validate('t34t34t433sdbvs'));
        $this->assertFalse(TagValidator::validate('apples'));
        $this->assertFalse(TagValidator::validate(null));
        $this->assertFalse(TagValidator::validate([]));
    }
}
