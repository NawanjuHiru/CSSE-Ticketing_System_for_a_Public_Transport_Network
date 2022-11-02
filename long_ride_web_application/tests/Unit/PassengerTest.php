<?php

namespace Tests\Feature;

use App\Http\Controllers\PassengerController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PassengerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    //This test case is to check whether the index page is loading
    public function test_passenger_index_is_loading()
    {
        $response = $this->get('/passenger/index/{type?}');
        $response->assertStatus(200);
    }

    //This test case is to test the passenger create function
    public function test_passenger_store_function()
    {
        $this->withoutMiddleware();

        $data = [
            'first_name' => 'Kamal',
            'last_name' => 'Perera',
            'email' => 'kamalp@gmail.com',
            'phone' => 94718292981,
            'password' => 'flex12345',
            'type' => 'Local',
            'cid' => 1,
            'status' => 1,
            'balance' => '1000',
            'image' => 'PASSENGER/p06.jpg',
        ];

        $passengerCtrl = new PassengerController();
        $response = $passengerCtrl->store($data);
        $this->assertEquals(true,$response);
    }

    //This function is to check whether the data is deleted according to the given id
    public function test_passenger_delete_function()
    {
        $this->withoutMiddleware();

        $passengerId = 10;
        $passengerCtrl = new PassengerController();
        $response = $passengerCtrl->destroy($passengerId);
        $this->assertNotEquals(false,$response);
    }

    //This test case is to test the create function in the PassengerController
    public function test_passenger_status_change()
    {
        $this->withoutMiddleware();
        $response = $this->postJson('/passenger/changePassengerStatus',['id' => 11,'status' => 1]);
        $response
        ->assertStatus(200)
        ->assertJson([
            'success' => 1
        ]);
    }

    //This test case is to test the update function in the PassengerController
    public function test_passenger_update_function()
    {
        $this->withoutMiddleware();

        $data = [
            'first_name' => 'Kamal',
            'last_name' => 'Perera',
            'email' => 'kamalp@gmail.com',
            'phone' => 94718292981,
            'password' => 'flex12345',
            'type' => 'Local',
            'cid' => 1,
            'status' => '0',
            'balance' => '1000',
            'image' => 'PASSENGER/p06.jpg',
        ];
        $passengerCtrl = new PassengerController();
        $response = $passengerCtrl->update($data,11);
        $this->assertEquals(true,$response);
    }
}
