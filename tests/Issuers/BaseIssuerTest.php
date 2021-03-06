<?php

namespace Amethyst\Tests\Issuers;

use Amethyst\Consumers\BaseConsumer;
use Amethyst\ConsumeRules\FrequencyConsumeRule;
use Amethyst\Fakers\ContractFaker;
use Amethyst\Fakers\ContractProductFaker;
use Amethyst\Fakers\LegalEntityFaker;
use Amethyst\Fakers\ProductFaker;
use Amethyst\Fakers\TargetFaker;
use Amethyst\Issuer\BaseIssuer;
use Amethyst\Managers\ContractManager;
use Amethyst\Managers\ContractProductManager;
use Amethyst\Managers\LegalEntityManager;
use Amethyst\Managers\PriceManager;
use Amethyst\Managers\ProductManager;
use Amethyst\Managers\TargetManager;
use Amethyst\PriceRules\BasePriceRule;
use Amethyst\Tests\BaseTest;
use Railken\Bag;

class BaseIssuerTest extends BaseTest
{
    /**
     * Test issuer.
     */
    public function testIssueContractSimpleProduct()
    {
        // Create a new product
        // Indicate what we're selling
        $pm = new ProductManager();
        $product = $pm->createOrFail(
            ProductFaker::make()->parameters()
                ->set('name', 'Subscription Lite')
                ->set('type.name', 'subscriptions')
        )->getResource();

        // Create a new target
        // Indicate to who we're selling
        $tm = new TargetManager();
        $target = $tm->createOrFail(
            TargetFaker::make()->parameters()
                ->set('name', 'Customers')
        )->getResource();

        // Indicate the price of the product we're selling
        $priceManager = new PriceManager();

        // Now that we're all sets, we can create a new contract
        // Create a new fresh contract
        $cm = new ContractManager();
        $contract = $cm->createOrFail(
            ContractFaker::make()->parameters()
                ->set('renewals', 0)
                ->remove('target')->set('target_id', $target->id)
        )->getResource();

        // Add the product to the contract
        $cpm = new ContractProductManager();
        $contractProduct = $cpm->createOrFail(
            ContractProductFaker::make()->parameters()
                ->set('renewals', 0)
                ->remove('contract')->set('contract_id', $contract->id)
                ->remove('product')->set('product_id', $product->id)
        )->getResource();

        $price = $priceManager->createOrFail(
            (new Bag())
                ->set('price_rule.name', 'Rule Name')
                ->set('price_rule.class_name', BasePriceRule::class)
                ->set('consume_rule.name', 'Rule Name')
                ->set('consume_rule.class_name', FrequencyConsumeRule::class)
                ->set('consume_rule.payload', [
                    'frequency_unit'  => 'months',
                    'frequency_value' => '1',
                ])
                ->set('price', 20)
                ->set('priceable_type', 'contract-product')
                ->set('priceable_id', $contractProduct->id)
                ->set('target_id', $target->id)
        )->getResource();

        // Refresh relations
        $contract = $cm->getRepository()->findOneById($contract->id);

        $consumer = new BaseConsumer();

        // Attiva in data x
        // Sospendi in data x
        // Riattiva in data x
        // Disattiva in data x

        // Only one item should be consumed (the recurring one)

        // Start contract and relative products
        $cm->start($contract);
        $cpm->start($contract->products[0]);

        $items = $consumer->getItemsToConsume($contract);

        $this->assertEquals(1, $items->count());
        $this->assertEquals(1, $items->get(0)->get('value'));

        $consumer->consume($contract);

        $issuer = new BaseIssuer();

        $items = $issuer->getItemsToIssue($contract);

        $sender = (new LegalEntityManager())->createOrFail(LegalEntityFaker::make()->parameters())->getResource();
        $invoice = $issuer->issue($sender, $contract);
        $this->assertEquals(1, $invoice->items->count());
    }
}
