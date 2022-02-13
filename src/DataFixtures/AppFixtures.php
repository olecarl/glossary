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
        $termSet = new TermSet('webdev');
        $manager->persist($termSet);
        $manager->flush();

        $this->addReference('term-set-webdev', $termSet);

        $term_1 = new Term();
        $term_1->setName('ddd');
        $term_1->setDescription('Domain Driven Design');
        $term_1->setTermSet($this->getReference('term-set-webdev'));
        $manager->persist($term_1);

        $term_2 = new Term();
        $term_2->setName('dry');
        $term_2->setDescription("Don't Repeat Yourself");
        $term_2->setTermSet($this->getReference('term-set-webdev'));
        $manager->persist($term_2);

        $term_3 = new Term();
        $term_3->setName('kiss');
        $term_3->setDescription('Keep it Simple and Stupid');
        $term_3->setTermSet($this->getReference('term-set-webdev'));
        $manager->persist($term_3);

        $manager->flush();
    }
}
