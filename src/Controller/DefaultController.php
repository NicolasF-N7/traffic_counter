<?php
namespace App\Controller;

use App\TrafficCounterManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    public function index(): Response
    {
        return new Response(
            '<html><body>Go to /visit?src=htw </body></html>'
        );
    }

    public function count(Request $request, TrafficCounterManager $traffic_manager): Response
    {
        $traffic_source = $request->query->get('src', 'unknown');

        // Store traffic source with TrafficCounterManager service
        $traffic_manager->storeVisit($traffic_source);


        return new Response(
            '<html><body>Source stored</body></html>'
        );
    }

    public function get_traffic(Request $request,  TrafficCounterManager $traffic_manager): Response
    {
        $traffic_source = $request->query->get('src', 'unknown');

        // Store traffic source with TrafficCounterManager service
        $result = $traffic_manager->countTrafficFromSource($traffic_source);


        return new Response(
            '<html><body>Counter: '.$result.'</body></html>'
        );
    }
}