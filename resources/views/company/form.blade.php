<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" required type="text" class="form-control" id="name"
                   placeholder="name"
                   maxlength="50"
            value="@isset($company){{ $company->name }}@endif">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input name="email" type="email" class="form-control" id="email"
                   placeholder="name@example.com"
                   maxlength="100"
                   value="@isset($company){{ $company->email }}@endif">
        </div>
    </div>
    <div class="col-md-12">
        <label>Logo: Choose a file @if(isset($company) && !is_null($company->logo)){{ 'to overwrite the existing logo' }}@endif</label>
        <div class="custom-file">
            <input name="logo" type="file" class="file-input" id="logo">
        </div>
    </div>
    @if(isset($company) && !is_null($company->logo) && \Illuminate\Support\Facades\Storage::disk('public')->exists($company->logo))
        <div class="col-md-12">
            <h3>Existing Logo</h3>
        </div>
        <div class="col-md-12">
            <img src="{{ asset('storage/'.$company->logo)}}" class="img-thumbnail" />
        </div>
    @endif
</div>