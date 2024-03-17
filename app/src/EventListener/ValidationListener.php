<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ValidationListener
{
    private SerializerInterface $serializer;
    private ValidatorInterface $validator;
    private const FORMAT = 'json';

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    #[AsEventListener(event: KernelEvents::CONTROLLER_ARGUMENTS)]
    public function onKernelControllerArguments(ControllerArgumentsEvent $event): void
    {
        $arguments = $event->getArguments();
        $data = $event->getRequest()->getContent();

        foreach ($arguments as $index => $argument) {
            if (preg_match('/.*Dto$/', $argument::class)) {
                $dto = $this->serializer->deserialize($data, $argument::class, self::FORMAT);
                $errors = $this->validator->validate($dto);

                if ($errors->count() > 0) {
                    throw new ValidationFailedException('Validation failed', $errors);
                }

                $arguments[$index] = $dto;
            }
        }
    }
}
