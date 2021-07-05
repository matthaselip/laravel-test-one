<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input required maxlength="50" type="text" class="form-control" id="first_name" name="first_name"
                value="@isset($employee){{ $employee->first_name }}@endisset">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input required maxlength="50" type="text" class="form-control" id="last_name" name="last_name"
                   value="@isset($employee){{ $employee->last_name }}@endisset">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="companies_id">Company</label>
            <select required name="companies_id" class="form-control" id="companies_id">
                @foreach($companies AS $company)
                    <option @if(isset($employee) && $company->companies_id === $employee->companies_id) selected @endif value="{{ $company->companies_id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="email">Email address</label>
            <input maxlength="100" name="email" type="email" class="form-control" id="email"
                   value="@isset($employee){{ $employee->email }}@endisset">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone"
                   value="@isset($employee){{ $employee->phone }}@endisset">
        </div>
    </div>
</div>