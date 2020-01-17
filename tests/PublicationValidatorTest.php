<?php
/**
 * Created by PhpStorm.
 * User: marek
 * Date: 2020-01-16
 * Time: 18:00
 */

use JournalMedia\Sample\Validator\PublicationValidator;
use PHPUnit\Framework\TestCase;

/**
 * Class PublicationValidatorTest
 */
class PublicationValidatorTest extends TestCase
{
    public function testValidate()
    {
        // Validate correct publications
        $this->assertTrue(PublicationValidator::validate('thejournal'));
        $this->assertTrue(PublicationValidator::validate('thescore'));
        $this->assertTrue(PublicationValidator::validate('thedailyedge'));
        $this->assertTrue(PublicationValidator::validate('businessetc'));

        // Validate incorrect pubications
        $this->assertFalse(PublicationValidator::validate('t34t34t433sdbvs'));
        $this->assertFalse(PublicationValidator::validate('apples'));
        $this->assertFalse(PublicationValidator::validate(null));
        $this->assertFalse(PublicationValidator::validate([]));
    }
}
