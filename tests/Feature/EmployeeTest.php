<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class EmployeeTest extends TestCase
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
     * create a test company
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function createCompany()
    {
        $company = Company::factory()->create();
        return $company;
    }
    /**
     * testing list of employees
     *
     * @return void
     */
    public function test_view_employees_list()
    {
        $response = $this->actingAs($this->createUser())->get(route('employees.index'));
        $response->assertStatus(200);
    }

    /**
     * testing deleting an employee
     *
     * @return void
     */
    public function test_delete_an_employee()
    {
        $employee = Employee::factory()->create();
        $user = $this->createUser();
        $response = $this->actingAs($user)->delete(route('employees.destroy',['employee' => $employee->employees_id]),[
            'employee' => $employee->employees_id
        ]);
        $response->assertStatus(302);
        $this->assertDeleted($employee);
    }

    /**
     * testing viewing an employee
     *
     * @return void
     */
    public function test_view_an_employee()
    {
        $employee = Employee::factory()->create();
        $user = $this->createUser();
        $response = $this->actingAs($user)->get(route('employees.show',['employee' => $employee->employees_id]));
        $response->assertStatus(200);
    }

    /**
     * updating an employee
     *
     * @return void
     */
    public function test_update_an_employee()
    {
        $employee = Employee::factory()->create();
        $user = $this->createUser();
        $newName = $this->faker->firstName;
        $response = $this->actingAs($user)->put(route('employees.update',['employee' => $employee->employees_id]),[
            'first_name' => $newName,
        ]);
        $response->assertStatus(302);
    }

    /**
     * creating a new employee
     *
     * @return void
     */
    public function test_creating_a_new_employee()
    {
        $employee = Employee::factory()->make();
        $response = $this->actingAs($this->createUser())->post(route('employees.store'),
        $employee->getAttributes());
        $response->assertStatus(302);
        $this->assertDatabaseHas($employee,$employee->getAttributes());
    }

    /**
     * viewing the edit psge
     *
     * @return void
     */
    public function test_view_edit_employee_page()
    {
        $employee = Employee::factory()->create();
        $response = $this->actingAs($this->createUser())->get(route('employees.edit',['employee' => $employee->employees_id]));
        $response->assertStatus(200);
    }

    /**
     * viewing the create form
     *
     * @return void
     */
    public function test_view_create_form()
    {
        $response = $this->actingAs($this->createUser())->get(route('employees.create'));
        $response->assertStatus(200);
    }

}
