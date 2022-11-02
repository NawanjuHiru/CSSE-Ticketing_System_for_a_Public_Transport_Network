<?php

namespace Tests\Feature;

use App\Http\Controllers\DailyRoutesController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{

    //This test case is to test the change avilablity status function in the DailyRouteController
    public function test_route_index_is_loading()
    {
        $response = $this->get('/route/index/{action?}');
        $response->assertStatus(200);
    }

    //This test case is to test the create function in the DailyRouteController
    public function test_the_change__route_status()
    {
        $this->withoutMiddleware();
        $response = $this->postJson('/route/changeRouteStatus',['id' => 1,'status' => 1]);
        $response
        ->assertStatus(200)
        ->assertJson([
            'success' => 1
        ]);
    }

    //This test case is to test the update function in the DailyRouteController
    public function test_route_store_function()
    {
        $this->withoutMiddleware();

        $data = [
            'routeNo' => '600',
            'mode' => 'bus',
            'startPoint' => 'Gampaha',
            'endpoint' => 'Kaluthara',
            'price' => '100',
        ];
        $dailyRoute = new DailyRoutesController();
        $response = $dailyRoute->store($data);
        $this->assertEquals(true,$response);
    }

    //This test case is to test the update function in the DailyRouteController
    public function test_route_update_function()
    {
        $this->withoutMiddleware();

        $data = [
            'routeNo' => '600',
            'mode' => 'train',
            'startPoint' => 'Gampaha',
            'endpoint' => 'Kaluthara',
            'price' => '100',
        ];
        $dailyRoute = new DailyRoutesController();
        $response = $dailyRoute->update($data,9);
        $this->assertEquals(true,$response);
    }

    //This test case is to test the destroy function in the DailyRouteController
    public function test_route_delete_function()
    {
        $this->withoutMiddleware();

        $routeId = 9;
        $dailyRoute = new DailyRoutesController();
        $response = $dailyRoute->destroy($routeId);
        $this->assertNotEquals(false,$response);
    }
}
