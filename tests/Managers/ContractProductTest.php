<?php

namespace Railken\Amethyst\Tests\Managers;

use Railken\Amethyst\Fakers\ContractProductFaker;
use Railken\Amethyst\Managers\ContractProductManager;
use Railken\Amethyst\Schemas\ContractProductSchema;
use Railken\Amethyst\Tests\BaseTest;
use Railken\Lem\Support\Testing\TestableBaseTrait;

class ContractProductTest extends BaseTest
{
    use TestableBaseTrait;

    /**
     * Manager class.
     *
     * @var string
     */
    protected $manager = ContractProductManager::class;

    /**
     * Faker class.
     *
     * @var string
     */
    protected $faker = ContractProductFaker::class;

    public function testStart()
    {
        $resource = $this->getManager()->create($this->faker::make()->parameters())->getResource();
        $result = $this->getManager()->start($resource);
        $this->assertEquals(ContractProductSchema::STATUS_STARTED, $result->getResource()->status);
    }

    public function testSuspend()
    {
        $resource = $this->getManager()->create($this->faker::make()->parameters())->getResource();
        $result = $this->getManager()->suspend($resource);
        $this->assertEquals(ContractProductSchema::STATUS_SUSPENDED, $result->getResource()->status);
    }

    public function testResume()
    {
        $resource = $this->getManager()->create($this->faker::make()->parameters())->getResource();
        $result = $this->getManager()->resume($resource);
        $this->assertEquals(ContractProductSchema::STATUS_STARTED, $result->getResource()->status);
    }

    public function testTerminate()
    {
        $resource = $this->getManager()->create($this->faker::make()->parameters())->getResource();
        $result = $this->getManager()->terminate($resource);
        $this->assertEquals(ContractProductSchema::STATUS_TERMINATED, $result->getResource()->status);
    }
}
