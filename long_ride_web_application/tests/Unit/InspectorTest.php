<?php

namespace Tests\Feature;

use App\Http\Controllers\TicketInspectorController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Request;

class InspectorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    //This test case is to test the create function in the TicketInspectorController
    public function test_inspector_create_function()
    {
        $this->withoutMiddleware();

        $data = [
            'firstname'=> 'Renuka',
            'lastname'=> 'Silva',
            'email'=>'renuka@gmail.com',
            'phone'=>'0712354657',
            'city'=>'Wattala',
            'password'=>'renuka123456',
            'route'=>'2',
            'avatar'=>'TicketInspector/images_B2.jpg',
        ];
        $request = new Request($data);
        $inspector = new TicketInspectorController();
        $response = $inspector->store($request);
        $this->assertTrue(true);
    }

    //This test case is to test the update function in the TicketInspectorController
    public function test_inspector_update_function()
    {
        $this->withoutMiddleware();

        $data = [
            'firstname'=> 'Dammini',
            'lastname'=> 'Silva',
            'email'=>'dammini@gmail.com',
            'phone'=>'0712354657',
            'city'=>'Wattala',
            'password'=>'dammini123456',
            'route'=>'2',
            'avatar'=>'TicketInspector/images_B2.jpg',
        ];

        $request = new Request($data);
        $inspector = new TicketInspectorController();
        $response = $inspector->update($request,12);
        $this->assertTrue(true);
    }

    //This test case is to test the destroy function in the TicketInspectorController
    public function test_inspector_delete_function()
    {
        $this->withoutMiddleware();

        $ins_id = 13;
        $timeTable = new TicketInspectorController();
        $response = $timeTable->destroy($ins_id);
        $this->assertNotEquals(false,$response);
    }

    //This test case is to test the index function in the TicketInspectorController
    public function test_inspector_index_is_loading()
    {
        $response = $this->get('/ticketInspector/index');
        $response->assertStatus(200);
    }

    //This test case is to test the store function in the TicketInspectorController
    public function test_inspector_store_invalid_function()
    {
        $this->withoutMiddleware();

        $data = [
            'firstname'=> 'Mahishi',
            'lastname'=> 'Kaldera',
            'email'=>'mahishi11@',
            'phone'=>'0712354777',
            'city'=>'Wallawatta',
            'password'=>'mahishi1234',
            'route'=>'2',
            'avatar'=>'TicketInspector/images_B2.jpg',
        ];
        $request = new Request($data);
        $inspector = new TicketInspectorController();
        $response = $inspector->store($request);
        $this->assertFalse(false);
    }



}


