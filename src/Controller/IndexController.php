<?php

namespace App\Controller;

use App\Service\GetCarDetailsService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IndexController
 */
class IndexController extends AbstractController
{
    /** @var LoggerInterface */
    private $logger;

    /** @var GetCarDetailsService */
    private $getCarDetails;

    public function __construct(
        LoggerInterface $logger,
        GetCarDetailsService $getCarDetails
    ) {
        $this->getCarDetails = $getCarDetails;
        $this->logger        = $logger;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request)
    {
        try {
            $carId = 181985;
            $data = $this->getCarDetails->execute($carId);

            return $this->render('index.html.twig', [
                'data' => $data,
            ]);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage());

            return new JsonResponse('error.unexpectedError', JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
