<?php

namespace Tests\Integration\TheJournalIe\Factory;

use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\GeneralFactory;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\ListArticlesByTagFactory;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\ListArticlesFactory;
use JournalMedia\Sample\Integration\TheJournalIE\Data\Factory\Type\AbstractFactoryEnum;
use Tests\TestCase;

/**
 * Class GeneralFactoryTest responsible for testing the General factory.
 * @package Tests\Integration\TheJournalIe\Factory
 *
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class GeneralFactoryTest extends TestCase
{
    /**
     * Test success creating ListArticlesFactory
     *
     * @throws \Exception
     */
    public function testCreateListArticlesFactory()
    {
        $generalFactory = new GeneralFactory;
        $abstractFactoryType = AbstractFactoryEnum::LIST_ARTICLES();

        $factory = $generalFactory->makeFactory($abstractFactoryType);

        $this->assertEquals(new ListArticlesFactory, $factory);
    }

    /**
     * Test success crate ListArticlesByTagFactory
     *
     * @throws \Exception
     */
    public function testCreateListArticlesByTagFactory()
    {
        $generalFactory = new GeneralFactory;
        $abstractFactoryType = AbstractFactoryEnum::LIST_ARTICLES_BY_TAG();

        $factory = $generalFactory->makeFactory($abstractFactoryType);

        $this->assertEquals(new ListArticlesByTagFactory(), $factory);
    }
}