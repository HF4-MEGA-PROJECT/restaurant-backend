<?php

namespace Tests\Feature\Reservation;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_reservations_can_be_fetched_when_one_reservation_exist()
    {
        Reservation::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('reservation.index'));

        $reservations = Reservation::all();

        $response->assertExactJson($reservations->toArray());
    }

    public function test_reservations_can_be_fetched_when_some_reservations_exist()
    {
        Reservation::factory()->create();
        Reservation::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('reservation.index'));

        $reservations = Reservation::all();

        $response->assertExactJson($reservations->toArray());
    }

    public function test_reservations_can_be_fetched_when_no_reservations_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('reservation.index'));

        $reservations = Reservation::all();

        $response->assertExactJson($reservations->toArray());
    }

    public function test_reservation_can_be_created()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('reservation.store'), [
            'name' => 'Frederik Milling Pytlick',
            'email' => 'frederikpyt@example.com',
            'phone' => '+4512345678',
            'time' => '2022-05-12 07:17:30',
            'amount_of_people' => 2,
        ]);

        $reservations = Reservation::all();

        $this->assertCount(1, $reservations);
        $this->assertEquals('Frederik Milling Pytlick', $reservations->first()->name);
        $this->assertEquals('frederikpyt@example.com', $reservations->first()->email);
        $this->assertEquals('+4512345678', $reservations->first()->phone);
        $this->assertEquals('2022-05-12 07:17:30', $reservations->first()->time);
        $this->assertEquals(2, $reservations->first()->amount_of_people);

        $response->assertExactJson($reservations->first()->toArray());
    }

    public function test_reservation_can_not_be_created_when_name_exceeds_max_length()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('reservation.store'), [
            'name' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string',
            'email' => 'frederikpyt@example.com',
            'phone' => '+4512345678',
            'time' => '2022-05-12 07:17:30',
            'amount_of_people' => 2,
        ]);

        $reservations = Reservation::all();

        $this->assertCount(0, $reservations);

        $response->assertStatus(422);
    }

    public function test_reservation_can_not_be_created_with_invalid_email()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('reservation.store'), [
            'name' => 'Frederik Milling Pytlick',
            'email' => 'frederikpyt////\@example.//com',
            'phone' => '+4512345678',
            'time' => '2022-05-12 07:17:30',
            'amount_of_people' => 2,
        ]);

        $reservations = Reservation::all();

        $this->assertCount(0, $reservations);

        $response->assertStatus(422);
    }

    public function test_reservation_can_not_be_created_with_invalid_phone_number()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('reservation.store'), [
            'name' => 'Frederik Milling Pytlick',
            'email' => 'frederikpyt@example.com',
            'phone' => '+4512345678123456781234567812345678123456781234567812345678123456781234567812345678123456781234567812345678',
            'time' => '2022-05-12 07:17:30',
            'amount_of_people' => 2,
        ]);

        $reservations = Reservation::all();

        $this->assertCount(0, $reservations);

        $response->assertStatus(422);
    }

    public function test_reservation_can_not_be_created_with_invalid_time()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('reservation.store'), [
            'name' => 'Frederik Milling Pytlick',
            'email' => 'frederikpyt@example.com',
            'phone' => '+4512345678',
            'time' => '2022-05-12 07',
            'amount_of_people' => 2,
        ]);

        $reservations = Reservation::all();

        $this->assertCount(0, $reservations);

        $response->assertStatus(422);
    }

    public function test_reservation_can_not_be_created_with_invalid_amount_of_people()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('reservation.store'), [
            'name' => 'Frederik Milling Pytlick',
            'email' => 'frederikpyt@example.com',
            'phone' => '+4512345678',
            'time' => '2022-05-12 07:35:00',
            'amount_of_people' => 0,
        ]);

        $reservations = Reservation::all();

        $this->assertCount(0, $reservations);

        $response->assertStatus(422);
    }

    public function test_reservation_can_be_fetched()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('reservation.show', ['reservation' => Reservation::factory()->create()]));

        $reservations = Reservation::all();

        $response->assertExactJson($reservations->first()->toArray());
    }

    public function test_reservation_can_be_updated()
    {
        $reservation = Reservation::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('reservation.update', $reservation), [
            'id' => $reservation->id,
            'name' => 'Frederik Milling Pytlick',
            'email' => 'frederikpyt@example.com',
            'phone' => '+4512345678',
            'time' => '2022-05-12 07:17:30',
            'amount_of_people' => 2,
        ]);

        $reservations = Reservation::all();

        $this->assertCount(1, $reservations);
        $this->assertEquals('Frederik Milling Pytlick', $reservations->first()->name);
        $this->assertEquals('frederikpyt@example.com', $reservations->first()->email);
        $this->assertEquals('+4512345678', $reservations->first()->phone);
        $this->assertEquals('2022-05-12 07:17:30', $reservations->first()->time);
        $this->assertEquals(2, $reservations->first()->amount_of_people);

        $response->assertExactJson($reservations->first()->toArray());
    }

    public function test_reservation_can_not_be_updated_when_name_exceeds_max_length()
    {
        $reservation = Reservation::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('reservation.update', $reservation), [
            'name' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string',
            'email' => 'frederikpyt@example.com',
            'phone' => '+4512345678',
            'time' => '2022-05-12 07:17:30',
            'amount_of_people' => 2,
        ]);

        $reservations = Reservation::all();

        $this->assertCount(1, $reservations);
        $this->assertEquals($reservation->name, $reservations->first()->name);
        $this->assertEquals($reservation->email, $reservations->first()->email);
        $this->assertEquals($reservation->phone, $reservations->first()->phone);
        $this->assertEquals($reservation->time, $reservations->first()->time);
        $this->assertEquals($reservation->amount_of_people, $reservations->first()->amount_of_people);

        $response->assertStatus(422);
    }

    public function test_reservation_can_not_be_updated_with_invalid_email()
    {
        $reservation = Reservation::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('reservation.update', $reservation), [
            'name' => 'Frederik Milling Pytlick',
            'email' => 'frederikpyt////\@example.//com',
            'phone' => '+4512345678',
            'time' => '2022-05-12 07:17:30',
            'amount_of_people' => 2,
        ]);

        $reservations = Reservation::all();

        $this->assertCount(1, $reservations);
        $this->assertEquals($reservation->name, $reservations->first()->name);
        $this->assertEquals($reservation->email, $reservations->first()->email);
        $this->assertEquals($reservation->phone, $reservations->first()->phone);
        $this->assertEquals($reservation->time, $reservations->first()->time);
        $this->assertEquals($reservation->amount_of_people, $reservations->first()->amount_of_people);

        $response->assertStatus(422);
    }

    public function test_reservation_can_not_be_updated_with_invalid_phone_number()
    {
        $reservation = Reservation::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('reservation.update', $reservation), [
            'name' => 'Frederik Milling Pytlick',
            'email' => 'frederikpyt@example.com',
            'phone' => '+4512345678123456781234567812345678123456781234567812345678123456781234567812345678123456781234567812345678',
            'time' => '2022-05-12 07:17:30',
            'amount_of_people' => 2,
        ]);

        $reservations = Reservation::all();

        $this->assertCount(1, $reservations);
        $this->assertEquals($reservation->name, $reservations->first()->name);
        $this->assertEquals($reservation->email, $reservations->first()->email);
        $this->assertEquals($reservation->phone, $reservations->first()->phone);
        $this->assertEquals($reservation->time, $reservations->first()->time);
        $this->assertEquals($reservation->amount_of_people, $reservations->first()->amount_of_people);

        $response->assertStatus(422);
    }

    public function test_reservation_can_not_be_updated_with_invalid_time()
    {
        $reservation = Reservation::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('reservation.update', $reservation), [
            'name' => 'Frederik Milling Pytlick',
            'email' => 'frederikpyt@example.com',
            'phone' => '+4512345678',
            'time' => '2022-05-12 07',
            'amount_of_people' => 2,
        ]);

        $reservations = Reservation::all();

        $this->assertCount(1, $reservations);
        $this->assertEquals($reservation->name, $reservations->first()->name);
        $this->assertEquals($reservation->email, $reservations->first()->email);
        $this->assertEquals($reservation->phone, $reservations->first()->phone);
        $this->assertEquals($reservation->time, $reservations->first()->time);
        $this->assertEquals($reservation->amount_of_people, $reservations->first()->amount_of_people);

        $response->assertStatus(422);
    }

    public function test_reservation_can_not_be_updated_with_invalid_amount_of_people()
    {
        $reservation = Reservation::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('reservation.update', $reservation), [
            'name' => 'Frederik Milling Pytlick',
            'email' => 'frederikpyt@example.com',
            'phone' => '+4512345678',
            'time' => '2022-05-12 07:35:00',
            'amount_of_people' => 0,
        ]);

        $reservations = Reservation::all();

        $this->assertCount(1, $reservations);
        $this->assertEquals($reservation->name, $reservations->first()->name);
        $this->assertEquals($reservation->email, $reservations->first()->email);
        $this->assertEquals($reservation->phone, $reservations->first()->phone);
        $this->assertEquals($reservation->time, $reservations->first()->time);
        $this->assertEquals($reservation->amount_of_people, $reservations->first()->amount_of_people);

        $response->assertStatus(422);
    }

    public function test_reservation_can_be_deleted()
    {
        $reservation = Reservation::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->deleteJson(route('reservation.destroy', $reservation));

        $this->assertCount(0, Reservation::all());

        $response->assertStatus(200);
    }
}
