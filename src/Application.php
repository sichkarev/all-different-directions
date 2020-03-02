<?php

namespace Sichkarev\Task;

use ArrayIterator;
use Sichkarev\Task\DataProviders\DataProviderInterface;
use Sichkarev\Task\Exceptions\ApplicationException;
use Sichkarev\Task\Exceptions\ValidatorException;
use Sichkarev\Task\Handlers\{DefaultExceptionHandler, ExceptionHandlerInterface};
use Sichkarev\Task\Parsers\BaseParser;
use Sichkarev\Task\Services\BaseService;
use Sichkarev\Task\Validators\ValidatorInterface;
use Traversable;

/**
 * Class Application
 *
 * @package Sichkarev\Task
 */
final class Application
{
    /**
     * @var \Sichkarev\Task\DataProviders\DataProviderInterface[]
     */
    private array $providers;

    private ExceptionHandlerInterface $exceptionHandler;

    private BaseParser $parser;

    private ValidatorInterface $validator;

    private BaseService $service;

    /**
     * Application constructor.
     */
    public function __construct(BaseService $service)
    {
        $this->setService($service);

        $this->exceptionHandler = new DefaultExceptionHandler();
    }

    private function setService(BaseService $service): void
    {
        $this->service = $service;
    }

    /**
     * Application constructor.
     *
     */
    public function addDataProvider(DataProviderInterface $provider): void
    {
        $this->providers[] = $provider;
    }

    /**
     * @throws ApplicationException
     */
    public function run(): int
    {
        try {
            $data = $this->getIterator();
            $this->validateData($data);

            foreach ($this->calculate($data) as $resultData) {
                echo sprintf('%.6g %.6g %.6g', $resultData->getX(), $resultData->getY(), $resultData->getDistance()) .
                     PHP_EOL;
            }
        } catch (\Throwable $e) {
            if ($this->exceptionHandler) {
                $this->exceptionHandler->handle($e);
            } else {
                throw new ApplicationException($e);
            }
        }

        return 1;
    }

    private function getIterator(): ArrayIterator
    {
        return new ArrayIterator(iterator_to_array($this->getDataFromProviders()));
    }

    /**
     * @return Traversable|\Sichkarev\Task\Models\BaseRow[]
     */
    private function getDataFromProviders(): Traversable
    {
        $i = 0;
        foreach ($this->providers as $provider) {
            foreach ($provider->getData() as $row) {
                yield $i => $this->parser->parseRow($row);
                $i++;
            }
        }
    }

    /**
     * @throws \Sichkarev\Task\Exceptions\ValidatorException
     */
    private function validateData(Traversable $data): Traversable
    {
        if ($this->validator && !$this->validator->isValid($data)) {
            throw new ValidatorException($this->validator->getErrorRule());
        }

        return $data;
    }

    /**
     * @return array|\Sichkarev\Task\Models\ResultData[]
     * @throws \Exception
     */
    private function calculate(ArrayIterator $data): array
    {
        return $this->service->calculate($data);
    }

    public function setExceptionHandler(ExceptionHandlerInterface $handler): void
    {
        $this->exceptionHandler = $handler;
    }

    public function setDataParser(BaseParser $parser): void
    {
        $this->parser = $parser;
    }

    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }
}
