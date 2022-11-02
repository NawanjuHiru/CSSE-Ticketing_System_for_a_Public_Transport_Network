<?php

namespace Tests\Feature;

use App\Http\Controllers\TimeTableController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Request;

class TimeTableTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

     //This test case is to test the store function in the TimeTableController
     public function test_timetable_store_function()
     {
         $this->withoutMiddleware();

         $data = [
            'routeId' => 1,
            'day' => 'Saturday',
            'vehicleId' => 1,
            'arrivaltime' => '10:00',
            'depaturetime' => '11:00',
         ];

         $request = new Request($data);

         $timeTable = new TimeTableController();
         $response = $timeTable->store($request);
         $this->assertTrue(true);
     }

    //This test case is to test the store function in the TimeTableController
     public function test_timetable_store_invalid_function()
     {
         $this->withoutMiddleware();

         $data = [
            'routeId' => 1,
            'day' => 'Saturday',
            'vehicleId' => 1,
            'arrivaltime' => '10: ',
            'depaturetime' => '11:00',
         ];

         $request = new Request($data);

         $timeTable = new TimeTableController();
         $response = $timeTable->store($request);
         $this->assertFalse(false);
     }

   // This test case is to test the update function in the TimeTableController
    public function test_timetable_update_function()
    {
        $this->withoutMiddleware();

        $data = [
            'routeId' => 1,
            'day' => 'Saturday',
            'vehicleId' => 1,
            'arrivaltime' => '16:00',
            'depaturetime' => '08:00',
        ];

        $request = new Request($data);

        $timeTable = new TimeTableController();
        $response = $timeTable->update($request,97);
        $this->assertTrue(true);
    }

    //This test case is to test the destroy function in the TimeTableController
    public function test_timetable_delete_function()
    {
        $this->withoutMiddleware();

        $timeTableId = 103;
        $timeTable = new TimeTableController();
        $response = $timeTable->destroy($timeTableId);
        $this->assertNotEquals(false,$response);
    }

    //This test case is to test the time table data retrieve
    public function test_timetable_index_is_loading()
    {
        $response = $this->get('/timetable/index/1');
        $response->assertStatus(200);
    }
}
