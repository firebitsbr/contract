<?php

namespace Railken\Amethyst\Fakers;

use Faker\Factory;
use Railken\Bag;
use Railken\Lem\Faker;

class ContractProductFaker extends Faker
{
    /**
     * @return \Railken\Bag
     */
    public function parameters()
    {
        $faker = Factory::create();

        $bag = new Bag();
        $bag->set('contract', ContractFaker::make()->parameters()->toArray());
        $bag->set('catalogue', CatalogueFaker::make()->parameters()->toArray());
        $bag->set('product', ProductFaker::make()->parameters()->toArray());
        $bag->set('renewals', 12);
        $bag->set('starts_at', (new \DateTime())->modify('-1 year')->format('Y-m-d'));
        $bag->set('ends_at', (new \DateTime())->modify('+1 year')->format('Y-m-d'));
        $bag->set('last_bill_at', (new \DateTime())->modify('-1 month')->format('Y-m-d'));
        $bag->set('next_bill_at', (new \DateTime())->format('Y-m-d'));

        return $bag;
    }
}