<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    use WithFaker;

    /**
     * create the dummy user
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function createUser()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);
        $this->be($user);
        return $user;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_view_companies()
    {
        $user = $this->createUser();
        $response = $this->actingAs($user)->get(route('companies.index'));
        $response->assertStatus(200);
    }

    /**
     * save a company to database
     *
     * @return void
     */
    public function test_store_a_company()
    {
        $user = $this->createUser();
        $em = $this->faker->safeEmail;
        $response = $this->actingAs($user)->post(route('companies.store'), [
            'name' => $this->faker->name,
            'email' => $em,
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('companies',['email' => $em]);

    }

    public function test_view_a_company()
    {
        $company = Company::factory()->create();
        $user = $this->createUser();
        $response = $this->actingAs($user)->get(route('companies.show',['company' => $company->companies_id]));
        $response->assertStatus(200);
    }

    public function test_update_company()
    {
        $company = Company::factory()->create();
        $user = $this->createUser();
        $newName = $this->faker->name;
        $newEmail = $this->faker->safeEmail;
        $response = $this->actingAs($user)->put(route('companies.update',['company' => $company->companies_id]),[
            'name' => $newName,
            'email' => $newEmail
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('companies',[
            'name' => $newName,
            'email' => $newEmail
        ]);

    }

    public function test_view_edit_page()
    {
        $user = $this->createUser();
        $company = Company::factory()->create();
        $response = $this->actingAs($user)->get(route('companies.edit',['company' => $company->companies_id]));
        $response->assertStatus(200);
    }

    public function test_delete_a_company()
    {
        $company = Company::factory()
            ->hasEmployees(10)
            ->create();
        $id = $company->companies_id;
        $user = $this->createUser();
        $response = $this->actingAs($user)->delete(route('companies.destroy',['company' => $company->companies_id]),[
            'company' => $company->companies_id
        ]);
        $response->assertStatus(302);
        $this->assertDeleted($company);
    }

    public function test_view_create_form()
    {
        $response = $this->actingAs($this->createUser())->get(route('companies.create'));
        $response->assertStatus(200);
    }

}
