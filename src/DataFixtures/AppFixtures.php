<?php

namespace App\DataFixtures;

use App\Entity\Term;
use App\Entity\TermSet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $termSet = new TermSet('functional');
        $manager->persist($termSet);
        $manager->flush();

        $this->addReference('term-set-functional', $termSet);

        $term = new Term();
        $term->setName('ddd');
        $term->setDescription('Domain Driven Design');
        $term->setTermSet($this->getReference('term-set-functional'));
        $manager->persist($term);
        $manager->flush();

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
