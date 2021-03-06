<?php

/*
 * This file is part of the Worldia presentation bundle package.
 * (c) Christian Daguerre <cdaguerre@worldia.com>
 */

namespace Dag\Bundle\RobotsBundle\Doctrine;

use Dag\Component\Robots\Repository\RuleRepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Christian Daguerre <christian@daguer.re>
 */
class RuleInitializer
{
    /**
     * @var array
     */
    private $rules;

    /**
     * @var ObjectManager
     */
    private $ruleManager;

    /**
     * @var RuleRepositoryInterface
     */
    private $ruleRepository;

    public function __construct(array $rules, ObjectManager $ruleManager, RuleRepositoryInterface $ruleRepository)
    {
        $this->rules = $rules;
        $this->ruleManager = $ruleManager;
        $this->ruleRepository = $ruleRepository;
    }

    public function initialize(OutputInterface $output = null)
    {
        try {
            $this->initializeRules($output);
        } catch (NonUniqueResultException $exception) {
            if ($output) {
                $output->writeln('Rules already initialized');
            }
        }
    }

    protected function initializeRules(OutputInterface $output = null)
    {
        foreach ($this->rules as $rule) {
            if (null === $rule = $this->ruleRepository->findOneBy(['route' => $data['route']])) {
                $rule = $this->ruleRepository->createNew();
                $rule->setRoute($data['route']);
                $rule->setHosts($data['hosts']);
                $rule->setTags($data['tags']);
                if ($output) {
                    $output->writeln(sprintf(
                        'Adding rule "<comment>%s</comment>". (<info>Tags: %s, Hosts: %s</info>)',
                        $data['route'],
                        implode(', ', $data['tags']),
                        implode(', ', $data['hosts'])
                    ));
                }
            }

            $this->ruleManager->persist($rule);
        }

        $this->ruleManager->flush();
    }
}
