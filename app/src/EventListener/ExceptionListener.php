<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Exception\ValidationFailedException;

final class ExceptionListener
{
    #[AsEventListener(event: KernelEvents::EXCEPTION)]
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof ValidationFailedException) {
            $data = $this->getValidationErrors($exception);
            $httpStatusCode = Response::HTTP_BAD_REQUEST;
        } elseif ($exception instanceof NotFoundHttpException) {
            $data = [
                'status' => Response::$statusTexts[Response::HTTP_NOT_FOUND],
                'message' => $exception->getMessage(),
            ];
            $httpStatusCode = Response::HTTP_NOT_FOUND;
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            $data = [
                'status' => Response::$statusTexts[Response::HTTP_METHOD_NOT_ALLOWED],
                'message' => $exception->getMessage(),
            ];
            $httpStatusCode = Response::HTTP_METHOD_NOT_ALLOWED;
        } else {
            $data = [
                'status' => Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR],
                'message' => $exception->getMessage(),
            ];
            $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        $response = new JsonResponse($data, $httpStatusCode);
        $event->setResponse($response);
    }

    private function getValidationErrors(ValidationFailedException $exception): array
    {
        $data = [
            'status' => Response::$statusTexts[Response::HTTP_BAD_REQUEST],
            'message' => $exception->getValue(),
        ];
        $errors = $exception->getViolations();
        foreach ($errors as $error) {
            $data['errors'][$error->getPropertyPath()] = $error->getMessage();
        }
        return $data;
    }
}
