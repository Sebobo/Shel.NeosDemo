<?php

$baseUrl = 'http://staging.neosdemo/';
$deploymentPath = '/var/www';

$node = new TYPO3\Surf\Domain\Model\Node('staging');
$node
    ->setHostname('staging.neosdemo')
    ->setOption('username', 'vagrant');

$application = new TYPO3\Surf\Application\TYPO3\Flow('staging');
$application->setVersion('3.0');
$application
    ->setOption('keepReleases', 3)
    ->setOption('composerCommandPath', 'composer')
    ->setOption('updateMethod', null)
    ->setOption('scriptIdentifier', 'opcache-reset-script')
    ->setOption('repositoryUrl', 'git@gitlab.com:Sebobo/neosdemo.git')
    ->setOption('TYPO3\\Surf\\Task\\Php\\WebOpcacheResetCreateScriptTask[baseUrl]', $baseUrl)
    ->setOption('TYPO3\\Surf\\Task\\Php\\WebOpcacheResetExecuteTask[baseUrl]', $baseUrl)
    ->setDeploymentPath($deploymentPath)
    ->addNode($node);

$workflow = new \TYPO3\Surf\Domain\Model\SimpleWorkflow();
$workflow
    ->beforeStage('transfer', 'TYPO3\\Surf\\Task\\Php\\WebOpcacheResetCreateScriptTask')
    ->afterStage('switch', 'TYPO3\\Surf\\Task\\Php\\WebOpcacheResetExecuteTask');

/** @var $deployment TYPO3\Surf\Domain\Model\Deployment "injected" into this script from Surf */
$deployment
    ->setWorkflow($workflow)
    ->addApplication($application);
