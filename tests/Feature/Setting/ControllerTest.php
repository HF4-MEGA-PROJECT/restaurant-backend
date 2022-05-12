<?php

namespace Tests\Feature\Setting;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_settings_can_be_fetched_when_one_setting_exist()
    {
        Setting::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('setting.index'));

        $settings = Setting::all();

        $response->assertExactJson($settings->toArray());
    }

    public function test_settings_can_be_fetched_when_some_settings_exist()
    {
        Setting::factory()->create();
        Setting::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('setting.index'));

        $settings = Setting::all();

        $response->assertExactJson($settings->toArray());
    }

    public function test_settings_can_be_fetched_when_no_settings_exist()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('setting.index'));

        $settings = Setting::all();

        $response->assertExactJson($settings->toArray());
    }

    public function test_setting_can_be_created()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('setting.store'), [
            'key' => 'max_amount_of_people',
            'value' => '64'
        ]);

        $settings = Setting::all();

        $this->assertCount(1, $settings);
        $this->assertEquals('max_amount_of_people', $settings->first()->key);
        $this->assertEquals(64, $settings->first()->value);

        $response->assertExactJson($settings->first()->toArray());
    }

    public function test_setting_can_not_be_created_when_key_exceeds_max_length()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('setting.store'), [
            'key' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string',
            'value' => '64'
        ]);

        $settings = Setting::all();

        $this->assertCount(0, $settings);

        $response->assertStatus(422);
    }

    public function test_setting_can_not_be_created_when_value_exceeds_max_length()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->postJson(route('setting.store'), [
            'key' => 'max_amount_of_people',
            'value' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string'
        ]);

        $settings = Setting::all();

        $this->assertCount(0, $settings);

        $response->assertStatus(422);
    }

    public function test_setting_can_be_fetched()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->getJson(route('setting.show', ['setting' => Setting::factory()->create()]));

        $settings = Setting::all();

        $response->assertExactJson($settings->first()->toArray());
    }

    public function test_setting_can_be_updated()
    {
        $setting = Setting::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('setting.update', $setting), [
            'id' => $setting->id,
            'key' => 'max_amount_of_people',
            'value' => '64'
        ]);

        $settings = Setting::all();

        $this->assertCount(1, $settings);
        $this->assertEquals('max_amount_of_people', $settings->first()->key);
        $this->assertEquals(64, $settings->first()->value);

        $response->assertExactJson($settings->first()->toArray());
    }

    public function test_setting_can_not_be_updated_when_key_exceeds_max_length()
    {
        $setting = Setting::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('setting.update', $setting), [
            'id' => $setting->id,
            'key' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string',
            'value' => '64'
        ]);

        $settings = Setting::all();

        $this->assertCount(1, $settings);
        $this->assertEquals($setting->key, $settings->first()->key);
        $this->assertEquals($setting->value, $settings->first()->value);

        $response->assertStatus(422);
    }

    public function test_setting_can_not_be_updated_when_value_exceeds_max_length()
    {
        $setting = Setting::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->putJson(route('setting.update', $setting), [
            'id' => $setting->id,
            'key' => 'max_amount_of_people',
            'value' => 'Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string Alt for lang string'
        ]);

        $settings = Setting::all();

        $this->assertCount(1, $settings);
        $this->assertEquals($setting->key, $settings->first()->key);
        $this->assertEquals($setting->value, $settings->first()->value);

        $response->assertStatus(422);
    }

    public function test_setting_can_be_deleted()
    {
        $setting = Setting::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $response = $this->deleteJson(route('setting.destroy', $setting));

        $this->assertCount(0, Setting::all());

        $response->assertStatus(200);
    }
}
