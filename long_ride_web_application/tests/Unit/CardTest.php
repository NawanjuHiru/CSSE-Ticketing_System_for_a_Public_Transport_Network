<?php

namespace Tests\Feature;

use App\Http\Controllers\CardController;
use App\Http\Controllers\DailyRoutesController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CardTest extends TestCase
{

    //This test case is to test the change avilablity status function in the CardController
    public function test_change_availablity_status_of_card()
    {
        $this->withoutMiddleware();
        $response = $this->postJson('/card/changeAvailabilityStatus',['id' => 3,'status' => 'No']);
        $response
        ->assertStatus(200)
        ->assertJson([
            'success' => 1
        ]);
    }

    //This test case is to test the create function in the CardController
    public function test_card_create_function()
    {
        $this->withoutMiddleware();

        $data = [
            'cardName' => 'Premium',
            'charge' => 2,
            'validity' => '6 Months',
        ];
        $dailyRoute = new CardController();
        $response = $dailyRoute->store($data);
        $this->assertNotEquals(false,$response);
    }

    //This test case is to test the update function in the CardController
    public function test_card_update_function()
    {
        $this->withoutMiddleware();

        $data = [
            'cardName' => 'Premium',
            'charge' => 3,
            'validity' => '6 Months',
        ];
        $card = new CardController();
        $response = $card->update($data,8);
        $this->assertEquals(true,$response);
    }

    //This test case is to test the destroy function in the CardController
    public function test_route_delete_function()
    {
        $this->withoutMiddleware();

        $cardId = 8;
        $card = new CardController();
        $response = $card->destroy($cardId);
        $this->assertNotEquals(false,$response);
    }
}
